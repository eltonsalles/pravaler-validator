<?php

namespace Pravaler\Component\Validator\Tests\Pravaler;

use PHPUnit\Framework\TestCase;
use Pravaler\Component\Validator\Validator;


class ValidatorTest extends TestCase
{
    public function testInvalidCpf()
    {
        $data = ['cpf' => '123.456.789-00'];

        $validator = new Validator([
            'cpf' => 'cpf'
        ]);
        $validator->validate($data);
        $result = $validator->isValid();

        $this->assertFalse($result);
    }

    public function testValidCpf()
    {
        $data = ['cpf' => '435.928.474-81'];

        $validator = new Validator([
            'cpf' => 'cpf'
        ]);
        $validator->validate($data);
        $result = $validator->isValid();

        $this->assertTrue($result);
    }

    public function testInvalidEmail()
    {
        $data = ['email' => 'email.invalid'];

        $validator = new Validator([
            'email' => 'email'
        ]);
        $validator->validate($data);
        $result = $validator->isValid();

        $this->assertFalse($result);
    }

    public function testValidEmail()
    {
        $data = ['email' => 'email@example.com'];

        $validator = new Validator([
            'email' => 'email'
        ]);
        $validator->validate($data);
        $result = $validator->isValid();

        $this->assertTrue($result);
    }

    public function testInvalidMax()
    {
        $data = ['max' => '10'];

        $validator = new Validator([
            'max' => 'max:15'
        ]);
        $validator->validate($data);
        $result = $validator->isValid();

        $this->assertFalse($result);
    }

    public function testValidMax()
    {
        $data = ['max' => '10'];

        $validator = new Validator([
            'max' => 'max:5'
        ]);
        $validator->validate($data);
        $result = $validator->isValid();

        $this->assertTrue($result);
    }

    public function testInvalidMin()
    {
        $data = ['min' => '10'];

        $validator = new Validator([
            'min' => 'min:5'
        ]);
        $validator->validate($data);
        $result = $validator->isValid();

        $this->assertFalse($result);
    }

    public function testValidMin()
    {
        $data = ['min' => '10'];

        $validator = new Validator([
            'min' => 'min:15'
        ]);
        $validator->validate($data);
        $result = $validator->isValid();

        $this->assertTrue($result);
    }

    public function testInvalidNumeric()
    {
        $data = ['numeric' => 'abc'];

        $validator = new Validator([
            'numeric' => 'numeric'
        ]);
        $validator->validate($data);
        $result = $validator->isValid();

        $this->assertFalse($result);
    }

    public function testValidNumeric()
    {
        $data = ['numeric' => '10'];

        $validator = new Validator([
            'numeric' => 'numeric'
        ]);
        $validator->validate($data);
        $result = $validator->isValid();

        $this->assertTrue($result);
    }

    public function testInvalidPasswordConfirm()
    {
        $data = [
            'password' => 'abc123',
            'password_confirm' => 'abc'
        ];

        $validator = new Validator([
            'password_confirm' => 'password_confirm'
        ]);
        $validator->validate($data);
        $result = $validator->isValid();

        $this->assertFalse($result);
    }

    public function testValidPasswordConfirm()
    {
        $data = [
            'password' => 'abc123',
            'password_confirm' => 'abc123'
        ];

        $validator = new Validator([
            'password_confirm' => 'password_confirm'
        ]);
        $validator->validate($data);
        $result = $validator->isValid();

        $this->assertTrue($result);
    }

    public function testInvalidRequired()
    {
        $data = [];

        $validator = new Validator([
            'required' => 'required'
        ]);
        $validator->validate($data);
        $result = $validator->isValid();

        $this->assertFalse($result);
    }

    public function testValidRequired()
    {
        $data = ['required' => 'abc'];

        $validator = new Validator([
            'required' => 'required'
        ]);
        $validator->validate($data);
        $result = $validator->isValid();

        $this->assertTrue($result);
    }

    public function testInvalidSize()
    {
        $data = ['size' => 'field'];

        $validator = new Validator([
            'size' => 'size:1:2'
        ]);
        $validator->validate($data);
        $result = $validator->isValid();

        $this->assertFalse($result);
    }

    public function testValidSize()
    {
        $data = ['size' => 'field'];

        $validator = new Validator([
            'size' => 'size:1:10'
        ]);
        $validator->validate($data);
        $result = $validator->isValid();

        $this->assertTrue($result);
    }

    /**
     * @expectedException \Pravaler\Component\Validator\Exception\CheckClassException
     */
    public function testExceptionClassCheck()
    {
        $data = ['field' => 'abc'];

        $validator = new Validator([
            'field' => 'rule_invalid'
        ]);
        $validator->validate($data);
        $validator->isValid();
    }
}
