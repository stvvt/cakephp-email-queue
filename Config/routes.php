<?php

// connectPluginShortRoutes('EmailQueue');

Router::connect('/emails', array('plugin'=>'email_queue', 'controller' => 'email_queues', 'action' => 'index'));
