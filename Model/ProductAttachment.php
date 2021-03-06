<?php

/**
 * Ecomteck
 * Copyright (C) 2018 Ecomteck
 *
 * NOTICE OF LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see http://opensource.org/licenses/gpl-3.0.html
 *
 * @category Ecomteck
 * @package Ecomteck_ProductAttachment
 * @copyright Copyright (c) 2018 Ecomteck
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author Ecomteck
 */

namespace Ecomteck\ProductAttachment\Model;

/**
 * ProductAttachment Model
 *
 * @method \Ecomteck\ProductAttachment\Model\Resource\Page _getResource()
 * @method \Ecomteck\ProductAttachment\Model\Resource\Page getResource()
 */
class ProductAttachment extends \Magento\Framework\Model\AbstractModel
{
    
    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'pt_products_grid';

    /**
     * @var string
     */
    protected $_cacheTag = 'pt_products_grid';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'pt_products_grid';

    /**
     * Initialize resource model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('Ecomteck\ProductAttachment\Model\ResourceModel\ProductAttachment');
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getProducts(\Ecomteck\ProductAttachment\Model\ProductAttachment $object)
    {
        $tbl = $this->getResource()->getTable("ecomteck_productattachment");
        $select = $this->getResource()->getConnection()->select()->from(
            $tbl,
            ['products']
        )
        ->where(
            'productattach_id = ?',
            (int)$object->getId()
        );

        $products = $this->getResource()->getConnection()->fetchCol($select);
        
        if ($products) {
            $products = explode('&', $products[0]);
        }

        return $products;
    }
}
