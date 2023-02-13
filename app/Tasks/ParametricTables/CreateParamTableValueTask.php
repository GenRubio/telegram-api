<?php

namespace App\Tasks\ParametricTables;

use App\Exceptions\GenericException;

class CreateParamTableValueTask
{
    private $tableName;
    private $entityName;
    private $createModel;
    private $createBackpackCrud;
    private $createHexagonalStructure;
    private $createResource;

    public function __construct(
        $tableName,
        $createModel = true,
        $createBackpackCrud = true,
        $createHexagonalStructure = true,
        $createResource = true
    ) {
        $this->tableName = $tableName;
        $this->entityName = $this->setEntityName();
        $this->createModel = $createModel;
        $this->createBackpackCrud = $createBackpackCrud;
        $this->createHexagonalStructure = $createHexagonalStructure;
        $this->createResource = $createResource;
    }

    public function run()
    {
        $this->validateOptions();
        $this->createModel();
        $this->createBackpackCrud();
        $this->createHexagonalStructure();
        $this->createResource();
    }

    private function createModel()
    {
        if ($this->createModel) {
        }
    }

    private function createBackpackCrud()
    {
        if ($this->createBackpackCrud) {
        }
    }

    private function createHexagonalStructure()
    {
        if ($this->createHexagonalStructure) {
        }
    }

    private function createResource()
    {
        if ($this->createResource) {
        }
    }

    private function setEntityName()
    {
        return str_replace(" ", "", ucwords(str_replace("_", " ", $this->tableName)));
    }

    private function validateOptions()
    {
        if ($this->createBackpackCrud && !$this->createModel) {
            throw new GenericException("No es posible crear Backpack CRUD sin el Modelo");
        }
        if ($this->createResource && !$this->createModel) {
            throw new GenericException("No es posible crear Resource sin el Modelo");
        }
        if ($this->createService && !$this->createModel) {
            throw new GenericException("No es posible crear Service sin el Modelo");
        }
        if ($this->createRepository && !$this->createService) {
            throw new GenericException("No es posible crear Respository sin el Service");
        }
    }
}
