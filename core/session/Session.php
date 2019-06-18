<?php
namespace App\Core\Session;

use App\Core\Fingerprint\FingerprintProvider;

final class Session {
    private $storage;
    private $id;
    private $data;
    private $fingerprintProvider;

    public function __construct(SessionStorage &$sessionStorage) {
        $this->fingerprintProvider = null;

        $this->storage = $sessionStorage;
        $this->data = (object) [];

        $sessionId = filter_input(INPUT_COOKIE, 'APPSESSION', FILTER_SANITIZE_STRING);
        $sessionId = \preg_replace('|[^A-z0-9]|', '', $sessionId);

        if (\strlen($sessionId) !== 32) {
            $sessionId = $this->generateSessionId();
        }

        $this->id = $sessionId;

        setcookie('APPSESSION', $this->id, time()+24*60*60, '/');
    }

    public function setFingerprintProvider(?FingerprintProvider &$fpp) {
        $this->fingerprintProvider = $fpp;
    }

    private function generateSessionId() {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        
        $id = '';
        for ($i=0; $i<32; $i++) {
            $id .= $characters[rand(0, strlen($characters)-1)];
        }

        return $id;
    }
    
    public function put($key, $value) {
        $this->data->$key = $value;
        $this->save();
    }

    public function get($key, $default = null) {
        if ($this->exists($key)) {
            return $this->data->$key;
        }

        return $default;
    }

    public function getData() {
        return $this->data;
    }

    public function clear() {
        $this->data = (object) [];
        $this->save();
    }

    public function exists($key) {
        return property_exists($this->data, $key);
    }

    
    public function remove(string $key) {
        if ($this->exists($key)) {
            unset($this->sessionData->$key);
        }
        
    }

    public function save() {
        if ($this->fingerprintProvider !== null) {
            $this->data->__fingerprint = $this->fingerprintProvider->provideFingerprint();
        }

        $this->storage->save($this->id, $this->data);
        setcookie('APPSESSION', $this->id, time()+24*60*60, '/');
    }

    public function reload() {
        $this->data = $this->storage->load($this->id);

        if ($this->fingerprintProvider === null) {
            return;
        }

        if (!$this->exists('__fingerprint')) {
            return;
        }

        $currentFP = $this->fingerprintProvider->provideFingerprint();
        $savedFP = $this->data->__fingerprint;

        if ($currentFP != $savedFP) {
            $this->clear();
        }
    }
}