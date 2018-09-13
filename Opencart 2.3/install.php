<?php

$this->load->model('user/user_group');
$this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'catalog/landing');
$this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'catalog/landing');
$this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'extension/feed/landing_sitemap');
$this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'extension/feed/landing_sitemap');
