<?php

namespace App\Validation;

use Respect\Validation\Factory;
use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException;


class Validator
{
    protected $errors;

    /**
     * The translator to use from the exception message.
     *
     * @var callable
     */
    protected $translator = null;

    public function __construct($translator = null)
    {
        $this->translator = $translator;
    }

    public function validate($request, array $rules)
    {
        foreach ($rules as $field => $rule) {
            try {
                //$rule->assert($request->getParam($field));
                $rule->setName(ucfirst($field))->assert($request->getParam($field));
            } catch (NestedValidationException $e) {
                //TRANSLATOR
                if ($this->translator) {
                    $e->setParam('translator', $this->translator);
                }

                //ENGLISH
                $this->errors[$field] = $e->getMessages();
            }
        }
        $_SESSION['errors'] = $this->errors;
        return $this;
    }

    public function failed()
    {
        return !empty($this->errors);
    }

    /**
     * Get errors.
     *
     * @return array The errors array.
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
