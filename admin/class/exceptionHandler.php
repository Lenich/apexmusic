<?php

function exception_handler($exception) {
    echo "<div><h2>Exception!</h2></div>";
    echo "<div style='font-size: 15pt;'>".$exception->getMessage()."</div>";
    echo "<div>".
        "<div>In file: <b>".$exception->getFile()."</b></div>".
        "In line: <b>".$exception->getLine()."</b></div>".
        "</div>";
}

set_exception_handler('exception_handler');