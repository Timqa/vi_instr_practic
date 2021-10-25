<?php
$response->setContent(sprintf('Hello %s', htmlspecialchars($name, ENT_QUOTES, 'UTF-8')));