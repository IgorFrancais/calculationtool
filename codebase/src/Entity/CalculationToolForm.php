<?php

namespace App\Entity;

use App\Repository\CalculationToolFormRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class CalculationToolForm
{
    private ?int $id = null;

    private ?float $vehiclePrice = null;

    private ?string $vehicleType = null;

    private ?float $feeBasic = null;

    private ?float $feeSpecial = null;

    private ?float $feeAssociation = null;

    private ?float $feeStorage = null;

    private ?float $total = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVehiclePrice(): ?float
    {
        return $this->vehiclePrice;
    }

    public function setVehiclePrice(float $vehiclePrice): static
    {
        $this->vehiclePrice = $vehiclePrice;

        return $this;
    }

    public function getVehicleType(): ?string
    {
        return $this->vehicleType;
    }

    public function setVehicleType(string $vehicleType): static
    {
        $this->vehicleType = $vehicleType;

        return $this;
    }

    public function getFeeBasic(): ?float
    {
        return $this->feeBasic;
    }

    public function setFeeBasic(float $feeBasic): static
    {
        $this->feeBasic = $feeBasic;

        return $this;
    }

    public function getFeeSpecial(): ?float
    {
        return $this->feeSpecial;
    }

    public function setFeeSpecial(float $feeSpecial): static
    {
        $this->feeSpecial = $feeSpecial;

        return $this;
    }

    public function getFeeAssociation(): ?float
    {
        return $this->feeAssociation;
    }

    public function setFeeAssociation(float $feeAssociation): static
    {
        $this->feeAssociation = $feeAssociation;

        return $this;
    }

    public function getFeeStorage(): ?float
    {
        return $this->feeStorage;
    }

    public function setFeeStorage(float $feeStorage): static
    {
        $this->feeStorage = $feeStorage;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): static
    {
        $this->total = $total;

        return $this;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint('vehicleType', new Assert\Choice([
            'choices' => ['Common', 'Luxury'],
            'message' => 'Choose a valid car type [Common, Luxury].',
        ]));
    }
}
