<?php

namespace Model;

use Entity\EventEntity;

use Model\AbstractModel;

class EventModel extends AbstractModel {
    public function __construct($em) {
        parent::__construct($em, EventEntity::class);
    }
}