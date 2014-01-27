<?php

connectPluginShortRoutes('EmailQueue');

Router::connect('/emailqueue', array('plugin'=>'EmailQueue', 'controller' => 'EmailQueues', 'action' => 'index'));
