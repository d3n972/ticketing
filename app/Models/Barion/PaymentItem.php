<?php

namespace App\Models\Barion;

use Illuminate\Database\Eloquent\Model;
use ItemModel;

class PaymentItem extends Model
{
    private ItemModel $itemModel;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->itemModel = new ItemModel();
        $this->itemModel->Unit = 'piece';
    }

    public function setName($name)
    {
        $this->itemModel->Name = $name;
        return $this;
    }

    public function setDescription($desc)
    {
        $this->itemModel->Description = $desc;
        return $this;
    }

    public function setQuantity($q)
    {
        $this->itemModel->Quantity = $q;
        return $this;
    }

    public function setUnit($u = 'piece')
    {
        $this->itemModel->Unit = $u;
        return $this;
    }

    public function setUnitPrice($up)
    {
        $this->itemModel->UnitPrice = $up;
        return $this;
    }

    public function setItemTotal($it)
    {
        $this->itemModel->ItemTotal = $it;
        return $this;
    }

    public function setSKU($sku)
    {
        $this->itemModel->SKU = $sku;
        return $this;
    }

    public static function Factory()
    {
        return new static();
    }

    public function getItem()
    {
        return $this->itemModel;
    }
}
