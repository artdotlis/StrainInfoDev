<!--
SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH

SPDX-License-Identifier: MIT
-->

# StrainInfo

[![release: 2026.02.0](https://img.shields.io/badge/rel-2026.02.0-blue.svg?style=flat-square)](https://github.com/LeibnizDSMZ/StrainInfo)
[![MIT LICENSE](https://img.shields.io/badge/License-MIT-brightgreen.svg?style=flat-square)](https://choosealicense.com/licenses/mit/)
[![Husky](https://img.shields.io/badge/Husky-enabled-brightgreen?style=flat-square)](https://github.com/typicode/husky)
[![PHPStan Enabled](https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat-square)](https://github.com/phpstan/phpstan)
[![ESLint Enabled](https://img.shields.io/badge/ESLint-enabled-brightgreen.svg?style=flat-square)](https://github.com/eslint/eslint)
[![Prettier Enabled](https://img.shields.io/badge/Prettier-enabled-brightgreen.svg?style=flat-square)](https://github.com/prettier/prettier)

[![DOI](https://zenodo.org/badge/932778634.svg)](https://doi.org/10.5281/zenodo.14872436)

---

## Description

In microbiology, the communication and comparison of research findings and data
is often complicated by the existence of a number of different designations and
identifiers for the same strain. StrainInfo is a service developed to provide a
resolution of microbial strain identifiers by storing culture collection numbers,
their relations, and deposition data.

---

## Requirements

### Default

- GNU/Linux
- PHP: ~8.4
- TS: ~5.9
- NODEJS: ~22

### Dev Container

- Docker
- Docker - Compose

### Web server

If you are using **Alpine Linux** as distribution, you can run the **bin/deploy/req.nginx.sh** script
as root to install all web server dependencies (web-server: nginx).

### Configuration

Create configuration files for the fullstack inside **configs/** and **strinf/backend/src/configs/** use **assets/templates** as an example.

- configs/deploy.local.yaml
- strinf/backend/src/configs/config.local.json

### Assets

To download all assets and external styles use **bin/deploy/fix.sh\*** (DSMZ only).

---

## Installation

To install StrainInfo run the following command:

```shell
NONCE_WEB="NONCE_IF_NEEDED" PURGE_CSS="true" make runBuild
```

For development run the following commands:

```shell
make runDev
```

This will package the project into the **public/straininfo** folder, which can be used by your web server.

---

## Acknowledgements

- Adam Podstawka
- Joaquim Sardà Carbasse
- Lorenz C. Reimer
- Julia Koblitz
- Julius Witte
- Isabel Schober

---

## Info:

Don't use StrainInfo docker implementation in production. All Dockerfiles should only be used in local environments, e.g. your computer or inside local intranet, for development or staging only.

## Citation

When using StrainInfo for research, please cite the database paper:

Artur Lissin, Isabel Schober, Julius F Witte, Helko Lüken, Adam Podstawka, Julia Koblitz, Boyke Bunk, Peter Dawyndt, Peter Vandamme, Paul de Vos, Jörg Overmann, Lorenz C Reimer, StrainInfo—the central database for linked microbial strain identifiers, Database, Volume 2025, 2025, baaf059, https://doi.org/10.1093/database/baaf059
