<?php

interface SelectBuilderContract {
    public function columns(array $columns): SelectBuilderContract;
    public function from(string $tableName): SelectBuilderContract;
    public function orderBy(string $orderColumn, string $orderDirection): SelectBuilderContract;
    public function reset(SelectContract $contract);
    public function build(): SelectContract;
}

interface SelectContract {
    public function execute(): void;
}

class SelectBuilder implements SelectBuilderContract {
    private Select $select;

    public function __construct()
    {
        $this->select = new Select();
    }

    public function reset(SelectContract $select) {
        $this->select = $select;
    }

    public function columns(array $columns): SelectBuilderContract
    {
        $this->select->columns = $columns;
        return $this;
    }

    public function from(string $tableName): SelectBuilderContract
    {
        $this->select->from = $tableName;
        return $this;
    }

    public function orderBy(string $orderColumn, string $orderDirection): SelectBuilderContract
    {
        $this->select->orderColumn = $orderColumn;
        $this->select->orderDirection = $orderDirection;
        return $this;
    }

    public function build(): SelectContract
    {
        return $this->select;
    }
}

class Select implements SelectContract {
    public array $columns;
    public string $from;
    public string $orderColumn;
    public string $orderDirection;

    public function execute(): void {
        echo $this;
    }

    public function __toString(): string
    {
        $columns = implode(',', $this->columns);
        return "select {$columns} from {$this->from} order by {$this->orderColumn} {$this->orderDirection}".PHP_EOL;
    }
}

$selectBuilder = new SelectBuilder();
$select = $selectBuilder
    ->columns(['name, last_name'])
    ->from('students')
    ->orderBy('name', 'DESC')
    ->build();

$select->execute();