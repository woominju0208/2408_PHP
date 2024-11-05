<?php

// 세션 시작 : 세션 시작전에 출력처리(echo, var_dump 등등)가 있으면 안된다.
session_start();

session_destroy();  // 세션 파기