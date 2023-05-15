<?php

namespace App\Application\Request;

use App\Application\Alerts\Error;
use App\Application\Config\Config;

trait RequestValidation
{
    private array $errors = [];

    protected function validate(array $data, array $rules): array|bool
    {
        foreach ($rules as $key => $rule) {
            foreach ($rule as $item)
                switch ($item) {
                    case 'required':
                        if (empty($data[$key])) {
                            $this->errors[$key][] = 'Поле пустое';
                        }
                        break;
                    case 'email':
                        if (!filter_var($data[$key], FILTER_VALIDATE_EMAIL)) {
                            $this->errors[$key][] = 'Неверный формат адреса электронной почты';
                        }
                        break;
                    case 'password_confirm':
                        if ($data[$key] !== $data[Config::get('validation.password.confirm')]) {
                            $this->errors[$key][] = 'Пароли не совпадают';
                        }
                        break;
                }
        }
        Error::store($this->errors);
        return $this->errors;
    }

    public function validationStatus(): bool
    {
        return empty($this->errors);
    }

    public function validationErrors(): array
    {
        return $this->errors;
    }

}