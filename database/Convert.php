<?php

function rupiah($number)
{
  $hasil_rupiah = "Rp. " . number_format($number, 0, ',', '.');
  return $hasil_rupiah;
}
