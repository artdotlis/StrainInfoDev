<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\sea\search;

use straininfo\server\shared\mvvm\view_model\struct\json\v2\StTaxE;
use straininfo\server\shared\mvvm\view_model\struct\json\v2\StStrE;
use straininfo\server\shared\mvvm\view_model\struct\json\v2\StRelDepositE;
use straininfo\server\interfaces\mvvm\view_model\chan\search\VMIntSeaOpt;

use function straininfo\server\shared\mvvm\view_model\struct\parser\str\v2\convert_strain_status as convert_strain_status_v2;
use function Safe\json_encode;
use function Safe\json_decode;

final class VMSeaOpt implements VMIntSeaOpt
{
    /**
     * @param array<int, string> $strains
     *
     * @return array{string, bool}
     */
    public function createMicJson(array $strains): array
    {
        $sea_str = '';
        foreach ($strains as $str) {
            $strain = VMSeaOpt::createStrainSearch($str);
            $sea_str .= ",{$strain}";
        }
        $sea_str = ltrim($sea_str, ',');
        $data = "[{$sea_str}]";
        return [$data, count($strains) === 0];
    }

    /**
     * @param array<int, string> $strains
     */
    public function createMicAllJson(array $strains, int $ind, int $cnt): string
    {
        $next = '';
        if ($ind > 0) {
            $next = ",\"next\":{$ind}";
        }
        $sea_str = '';
        foreach ($strains as $str) {
            $strain = VMSeaOpt::createStrainSearch($str);
            $sea_str .= ",{$strain}";
        }
        $sea_str = ltrim($sea_str, ',');
        return "{\"data\":[{$sea_str}]{$next},\"count\":{$cnt}}";
    }

    /**
     * @return array<string>
     */
    private static function createCultureRelation(object $strain_con): array
    {
        $des_con = [];
        if (!property_exists($strain_con, StRelDepositE::REL_CON->value)) {
            return $des_con;
        }
        $relation = get_object_vars($strain_con)[StRelDepositE::REL_CON->value];
        if (
            !\is_object($relation) ||
            !property_exists($relation, StRelDepositE::REL_DEP_CON->value) ||
            !is_array(get_object_vars($relation)[StRelDepositE::REL_DEP_CON->value])
        ) {
            return $des_con;
        }
        foreach (get_object_vars($relation)[StRelDepositE::REL_DEP_CON->value] as $des) {
            if (!is_object($des) || !property_exists($des, StRelDepositE::DES->value)) {
                continue;
            }
            $ndes = get_object_vars($des)[StRelDepositE::DES->value];
            if (is_string($ndes)) {
                $des_con[] = $ndes;
            }
        }
        return $des_con;
    }

    private static function createTaxonName(object $strain_con): string
    {
        if (
            !property_exists($strain_con, StTaxE::TAX_CON->value)
        ) {
            return '';
        }
        $tax_con = get_object_vars($strain_con)[StTaxE::TAX_CON->value];
        if (
            !is_object($tax_con) ||
            !property_exists($tax_con, StTaxE::NAME->value)
        ) {
            return '';
        }
        $t_name = get_object_vars($tax_con)[StTaxE::NAME->value];
        if (\is_string($t_name)) {
            return $t_name;
        }
        return '';
    }

    private static function createTypeStr(object $strain_con): int
    {
        if (!property_exists($strain_con, StStrE::TYP_STR->value)) {
            return 0;
        }
        $t_str = get_object_vars($strain_con)[StStrE::TYP_STR->value];
        if (!is_bool($t_str)) {
            return 0;
        }
        return (int) $t_str;
    }

    private static function createStrainStatus(object $strain_con): int
    {
        if (!property_exists($strain_con, StStrE::STA->value)) {
            return 0;
        }
        $sta = get_object_vars($strain_con)[StStrE::STA->value];
        if (!is_string($sta)) {
            return 0;
        }
        return convert_strain_status_v2($sta);
    }

    private static function createCountryCode(object $strain_con): string
    {
        if (!property_exists($strain_con, StStrE::SAM_CON->value)) {
            return '';
        }
        $sample = get_object_vars($strain_con)[StStrE::SAM_CON->value];
        if (
            !is_object($sample) ||
            !property_exists($sample, StStrE::SAM_CC->value)
        ) {
            return '';
        }
        $s_cc = get_object_vars($sample)[StStrE::SAM_CC->value];
        if (!\is_string($s_cc)) {
            return '';
        }
        return $s_cc;
    }

    private static function createSiID(object $strain_con): int
    {
        if (!property_exists($strain_con, StStrE::SI_ID->value)) {
            return 0;
        }
        $si_id = get_object_vars($strain_con)[StStrE::SI_ID->value];
        if (\is_int($si_id)) {
            return $si_id;
        }
        return 0;
    }

    private static function createStrainSearch(string $json): string
    {
        $strain = json_decode($json);
        $si_id = 0;
        $rel = [];
        [$tax, $code] = ['', ''];
        $typ = false;
        $status = 0;
        if (is_object($strain) && property_exists($strain, StStrE::CON->value)) {
            $strain_con = $strain->strain;
            if (is_object($strain_con)) {
                $si_id = VMSeaOpt::createSiID($strain_con);
                $rel = VMSeaOpt::createCultureRelation($strain_con);
                $tax = VMSeaOpt::createTaxonName($strain_con);
                $typ = VMSeaOpt::createTypeStr($strain_con);
                $code = VMSeaOpt::createCountryCode($strain_con);
                $status = VMSeaOpt::createStrainStatus($strain_con);
            }
        }
        return json_encode([$si_id, $rel, $tax, $typ, $code, $status]);
    }
}
