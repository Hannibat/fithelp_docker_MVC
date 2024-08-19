<?php

define('REGEX_NAME',"^[A-Za-zéèêëàâäôöûüç' -]+$");
define('REGEX_PASSWORD','^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$');
define('REGEX_BIRTHDATE','^\d{4}(-\d{2}){2}$');
define('UPLOAD_DIR', 'public/uploads');

define('AUTHORIZED_IMAGE_FORMAT', ['image/jpeg', 'image/png', 'image/gif']);
define('MAX_FILESIZE', 2*1024*1024);