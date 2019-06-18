<?php 
    final class Configuration {
        const BASE = 'http://localhost/Biblioteka/';

        const DATABASE_HOST = 'localhost';
        const DATABASE_USER = 'root';
        const DATABASE_PASS = '';
        const DATABASE_NAME = 'library';

        const SESSION_STORAGE_CLASS = '\\App\\Core\\Session\\FileSessionStorage';
        const SESSION_STORAGE_ARGUMENTS = [ './sessions/' ]; # !!!

        const FINGERPRINT_PROVIDER_CLASS = '\\App\\Core\\Fingerprint\\BasicFingerprintProvider';
    }