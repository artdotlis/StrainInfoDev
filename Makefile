# SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
#
# SPDX-License-Identifier: MIT

ifeq ($(CONTAINER),container)
$(info Makefile enabled, proceeding ...)
else	
$(error Error: Makefile disabled, exiting ...)
endif

SHELL := /bin/bash
ROOT_MAKEFILE:=$(abspath $(patsubst %/, %, $(dir $(abspath $(lastword $(MAKEFILE_LIST))))))

$(shell $(ROOT_MAKEFILE)/bin/install/env.sh $(ROOT_MAKEFILE)/package.env > .env.mk)
-include .env.mk

export

DENO_DIR=$(HOME)/$(DENO_DIR_R)
DENO_CACHE=$(HOME)/$(DENO_CA_R)

export PATH := $(PATH):$(ROOT_MAKEFILE)/$(UV_INSTALL_DIR)/:$(HOME)/$(DENO_BIN_R):$(ROOT_MAKEFILE)/$(PHP_VENDOR_BE)/bin:$(HOME)/.local/bin
OLLAMA_MODEL?=qwen3.6:27b-q4_K_M

$(eval UVEL := $(shell which uv && echo "true" || echo ""))
$(eval DENOEL := $(shell which deno && echo "true" || echo ""))
$(eval COMPOSEREL := $(shell which composer && echo "true" || echo ""))

UVE = $(if $(UVEL),uv,$(ROOT_MAKEFILE)/$(UV_INSTALL_DIR)/uv)
DENOE = $(if $(DENOEL),deno,$(ROOT_MAKEFILE)/$(DENO_BIN_R)/deno)
COMPOSERE = $(if $(COMPOSEREL),composer,$(HOME)/.local/bin/composer)

COMPOSER_BE=cd $(ROOT_MAKEFILE)/$(STRINF_BACKEND) && $(COMPOSERE)
DENO_FE=cd $(ROOT_MAKEFILE)/$(STRINF_FRONTEND) && $(DENOE)
DENO_API=cd $(ROOT_MAKEFILE)/$(STRINF_API) && $(DENOE)

dev: NODE_ENV = development
dev: setupDeno setupComposer setupUv postInstall	
	$(COMPOSER_BE) install -d $(ROOT_MAKEFILE)/$(STRINF_BACKEND_SRC)
	$(DENOE) install --frozen-lockfile
	$(UVE) sync --frozen --all-groups
	find .git/hooks -name "*.old" -delete
	$(UVE) run lefthook uninstall 2>&1 || echo "not installed"
	$(UVE) run lefthook install
	@HOOK_FILE=.git/hooks/pre-push; \
	if ! grep -q "git lfs pre-push" $$HOOK_FILE; then \
		echo "command -v git-lfs >/dev/null && git lfs pre-push \"\$$@\"" >> $$HOOK_FILE; \
		echo "added 'git lfs pre-push' to pre-push hook."; \
	fi

build: NODE_ENV = production
build: setupDeno setupComposer setupUv postInstall 
	$(UVE) sync --frozen
	$(COMPOSER_BE) install -d $(ROOT_MAKEFILE)/$(STRINF_BACKEND_SRC) --no-dev
	$(DENOE) install --frozen-lockfile

tests: setupDeno setupComposer setupUv postInstall 
	$(COMPOSER_BE) install -d $(ROOT_MAKEFILE)/$(STRINF_BACKEND_SRC)
	$(DENOE) install --frozen-lockfile
	$(UVE) sync --frozen --group test

setupDeno:	
	bash $(ROOT_MAKEFILE)/$(BIN_INSTALL_DENO)	

setupUv:
	bash $(ROOT_MAKEFILE)/$(BIN_INSTALL_UV)

setupComposer:
	bash $(ROOT_MAKEFILE)/$(BIN_INSTALL_COMPOSER)

postInstall: 
	bash $(ROOT_MAKEFILE)/$(BIN_DEPLOY_FIX)

cleanBuild:
	rm -rf $(ROOT_MAKEFILE)/$(PROFILE_DIR)
	rm -rf $(ROOT_MAKEFILE)/$(APP)

clean: cleanBuild
	rm -rf $(ROOT_MAKEFILE)/node_modules || echo "empty"
	rm -rf $(ROOT_MAKEFILE)/$(STRINF_API)/node_modules || echo "empty"
	rm -rf $(ROOT_MAKEFILE)/$(STRINF_FRONTEND)/node_modules || echo "empty"
	rm -rf $(ROOT_MAKEFILE)/$(PHP_VENDOR_BE) || echo "empty"
	rm -rf $(ROOT_MAKEFILE)/$(CACHE_DIR) || echo "empty"
	rm -rf $(ROOT_MAKEFILE)/$(EXTRA_STYLE) || echo "empty"
	rm -rf $(ROOT_MAKEFILE)/$(EXTRA_ASSETS) || echo "empty"
	rm -rf $(HOME)/$(DENO_CA_R) || echo "empty"
	rm -rf $(ROOT_MAKEFILE)/$(UV_CACHE_DIR) || echo "empty"

uninstall: clean
	rm -rf $(HOME)/$(DENO_DIR_R) || echo "not installed"
	rm -f $(COM_BIN) || echo "not installed"
	rm -rf $(ROOT_MAKEFILE)/$(UV_DIR) || echo "not installed"

unstaged:
	@if ! git diff --quiet --exit-code; then \
		echo "ERROR: Unstaged changes found!"; \
		git diff; \
		exit 1; \
	fi
	@echo "No unstaged changes. Proceeding..."

setupLicense: unstaged
	bash $(BIN_RUN_LICENSE_LINT)
	git add .

RAN := $(shell awk 'BEGIN{srand();printf("%d", 65536*rand())}')

runAct:
	@echo "source .venv/bin/activate; rm /tmp/$(RAN)" > /tmp/$(RAN)
	bash --init-file /tmp/$(RAN)

runChecks: dev
	$(UVE) run lefthook run pre-commit --all-files -f

createBuild: NODE_ENV = production
createBuild: cleanBuild
	# Prepare
	[ -d $(ROOT_MAKEFILE)/$(EXTRA_STYLE) ]	|| $(shell echo "FAILED" && exit 1)
	[ 'true' = "$(STAGE)" ] && bash $(ROOT_MAKEFILE)/$(BIN_BACKEND_CHANGE_PORT) "stage" || echo "NOT STAGE"
	mkdir -p $(ROOT_MAKEFILE)/$(APP_STRINF)
	# Build
	$(DENO_API) run build 
	bash $(BIN_BACKEND_BUNDLE)
	$(DENO_FE) run build 
	# Compress
	@find $(ROOT_MAKEFILE)/$(APP_STRINF_PUB) -type f -not -name "*.gz" -not -name "index.html" -size +1k -exec gzip -9 -k {} \; -exec bash -c 'for file in "$$@"; do original_size=$$(stat -c %s "$$file"); gzipped_size=$$(stat -c %s "$$file.gz"); threshold=$$((original_size * 95 / 100)); if [ "$$gzipped_size" -ge "$$threshold" ]; then rm "$$file.gz"; fi; done' bash {} +

runBuild: build createBuild	

runStage: STAGE = true
runStage: build createBuild		
	bash $(BIN_TRAP_SH) 'bash $(BIN_BACKEND_RUN_STAGE)' '$(DENO_FE) run serve'

runDev: dev
	[ -d $(ROOT_MAKEFILE)/$(EXTRA_STYLE) ] || $(shell echo "FAILED" && exit 1)
	bash $(ROOT_MAKEFILE)/$(BIN_BACKEND_CHANGE_PORT) "dev"
	$(DENO_API) run build
	bash $(BIN_TRAP_SH) 'bash $(BIN_BACKEND_RUN_DEV)' '$(DENO_FE) run dev'

runProfile: BENCHMARK = true
runProfile: dev createBuild
	bash $(BIN_BACKEND_RUN_PROFILE)

runBump: unstaged
	$(UVE) run cz bump --files-only --yes --changelog
	git add .
	$(UVE) run cz version --project | xargs -i git commit -am "bump: release {}"

runLock runUpdate: %: export_% dev

export_runLock:
	$(UVE) lock
	$(DENOE) install --lockfile-only --exact --no-cache
	$(COMPOSER_BE) install
	$(MAKE) clean

export_runUpdate:
	$(UVE) lock -U
	$(COMPOSER_BE) update -d $(ROOT_MAKEFILE)/$(STRINF_BACKEND_SRC) 
	$(DENOE) cache --lock-write --reload
	$(MAKE) clean

runCron: dev
	bash $(ROOT_MAKEFILE)/$(BIN_BACKEND_RUN_CRON)

runTests: STAGE = true
runTests: build createBuild	
	bash $(BIN_TRAP_SH) 'bash $(BIN_BACKEND_RUN_STAGE)' 'bash $(BIN_RUN_TESTS)'

com commit:
	@echo "" > .commit_msg
	@if curl -sf http://ollama:11434; then \
		$(MAKE) message || exit 1; \
	else \
		$(UVE) run cz commit || exit 1; \
	fi
	@echo "" > .commit_msg

recom recommit:
	@if curl -sf http://ollama:11434; then \
		[ -s .commit_msg ] || (echo "Missing commit message!" && exit 1); \
		git commit -F .commit_msg || exit 1; \
	else\
		$(UVE) run cz commit --retry || exit 1; \
	fi
	@echo "" > .commit_msg

message:
	git diff --staged -U0 --no-prefix -- . ':(exclude)uv.lock' ':(exclude)*deno.lock' ':(exclude)*composer.lock' | \
		sed 's/  */ /g' | \
		jq -Rs --rawfile prompt configs/prompt/commit.md \
			'{"stream": false, "model": "$(OLLAMA_MODEL)", "prompt": ("<GIT_DIFF>" + . + "</GIT_DIFF>" + $$prompt)}' | \
		curl -s -X POST http://ollama:11434/api/generate \
			-H "Content-Type: application/json" \
			-d @- | \
		jq -r 'select(.done == true) | .response' > .commit_msg
	vim .commit_msg
	@if ! $(UVE) run cz check --commit-msg-file .commit_msg; then \
		echo "Commit message failed cz check. Aborting."; \
		echo "" > .commit_msg; \
		exit 1; \
	fi
	git commit -F .commit_msg
