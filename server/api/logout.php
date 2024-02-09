<?php

setcookie("authToken", null, path: "/");
header("Location: /");