<?php
/**
 * Created by PhpStorm.
 * Company: Rapicart
 * Web: https://www.rapicart.com
 * User: Pablo Garcia
 * Email: pablo.garcia@rapicart.com
 * Date: 29/08/17
 * Time: 14:27
 */

namespace Rapicart\Regions\Setup;

use Magento\Directory\Helper\Data;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    /**
     * Directory data
     *
     * @var Data
     */
    private $directoryData;

    /**
     * Init
     *
     * @param Data $directoryData
     */
    public function __construct(Data $directoryData)
    {
        $this->directoryData = $directoryData;
    }
    /**
     * Function install
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $data = [
            ['AR', 'BA', 'Buenos Aires'],
            ['AR', 'CABA', 'Ciudad Autónoma de Buenos Aires'],
            ['AR', 'GBA', 'Gran Buenos Aires'],
            ['AR', 'CT', 'Catamarca'],
            ['AR', 'CC', 'Chaco'],
            ['AR', 'CH', 'Chubut'],
            ['AR', 'CB', 'Cordoba'],
            ['AR', 'CR', 'Corrientes'],
            ['AR', 'ER', 'Entre Rios'],
            ['AR', 'FO', 'Formosa'],
            ['AR', 'JY', 'Jujuy'],
            ['AR', 'LP', 'La Pampa'],
            ['AR', 'LR', 'La Rioja'],
            ['AR', 'MZ', 'Mendoza'],
            ['AR', 'MN', 'Misiones'],
            ['AR', 'NQ', 'Neuquén'],
            ['AR', 'RN', 'Río Negro'],
            ['AR', 'SA', 'Salta'],
            ['AR', 'SJ', 'San Juan'],
            ['AR', 'SL', 'San Luis'],
            ['AR', 'SC', 'Santa Cruz'],
            ['AR', 'SF', 'Santa Fe'],
            ['AR', 'SE', 'Santiago del Estero'],
            ['AR', 'TF', 'Tierra del Fuego,  Antártida e Islas del Atlántico Sur'],
            ['AR', 'TM', 'Tucumán']
        ];

        foreach ($data as $row) {
            $bind = ['country_id' => $row[0], 'code' => $row[1], 'default_name' => $row[2]];
            $setup->getConnection()->insert($setup->getTable('directory_country_region'), $bind);
            $regionId = $setup->getConnection()->lastInsertId($setup->getTable('directory_country_region'));

            $bind = ['locale' => 'en_US', 'region_id' => $regionId, 'name' => $row[2]];
            $setup->getConnection()->insert($setup->getTable('directory_country_region_name'), $bind);
        }
    }
}