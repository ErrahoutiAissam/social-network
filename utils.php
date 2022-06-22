<?php

  function strToTitle(string $str, $limit = 10) : string {
    return implode(" ", array_slice(explode(" ", $str), 0, $limit)) . '...';
  }