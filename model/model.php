<?php

function getStoreInfo()
{
    return json_decode(file_get_contents("model/dataStorage/storeInfo.json"),true);
}
?>
