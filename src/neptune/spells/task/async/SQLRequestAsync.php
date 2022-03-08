<?php

namespace neptune\spells\task\async;

use neptune\spells\network\SQLManager;
use pocketmine\scheduler\AsyncTask;

class SQLRequestAsync extends AsyncTask {

    /** @var int $requestType */
    public int $requestType;

    /** @var string $statement */
    public string $statement;

    /** @var bool $finished */
    public bool $finished = false;

    public function __construct(string $statement, int $requestType){
        $this->statement = $statement;
        $this->requestType = $requestType;
    }

    public function onRun() : void {
        switch ($this->requestType){
            case SQLManager::REQUEST_WRITE:
                SQLManager::writeData($this->statement, SQLManager::DATABASE_SPELLS);
                break;
            case SQLManager::REQUEST_EXIST:
                $this->setResult(SQLManager::dataExist($this->statement, SQLManager::DATABASE_SPELLS));
                break;
            case SQLManager::REQUEST_GET:
                $this->setResult(SQLManager::getData($this->statement, SQLManager::DATABASE_SPELLS));
                break;
        }
    }

    public function onCompletion() : void {
        $this->finished = true;
    }
}