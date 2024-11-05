<?php

// 세션 시작 : 세션 시작전에 출력처리(echo, var_dump 등등)가 있으면 안된다.
session_start();

// 쿠키에 세션 id 생성 후 저장
$_SESSION['test_session'] = '세션1';