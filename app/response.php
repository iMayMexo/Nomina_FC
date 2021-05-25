<?php
header('Content-Disposition: attachment; filename=data.json');
header('Content-Type: application/json');
echo $_POST['data'];
exit;