<?php

namespace App\Models;

class Pegawai
{
    public function __construct(
        public User $user,
        public Bidang $bidang,
        public string $nama,
        public string $nip,
    ) {}
}
