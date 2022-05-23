<?php

declare(strict_types=1);

namespace Codes\App\Entities;

use Database\Factories\CustomerFactory;
use Doctrine\ORM\Mapping as ORM;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @ORM\Entity
 * @ORM\Table(name="customers")
 */
class Customer
{
    use HasFactory;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $username;
    private string $gender;
    private string $country;
    private string $city;
    private string $phone;

    public static function fromState(array $state): self
    {
        return new self($state);
    }

    public function __construct(array $params = [])
    {
        $this->id = $params['id'] ?? 0;
        $this->firstName = $params['first_name'];
        $this->lastName = $params['last_name'];
        $this->email = $params['email'];
        $this->username = $params['username'];
        $this->password = md5($params['password']);
        $this->gender = $params['gender'];
        $this->country = $params['country'];
        $this->city = $params['city'];
        $this->phone = $params['phone'];
    }

    protected static function newFactory()
    {
        return CustomerFactory::new();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setUsername($username): void
    {
        $this->username = $username;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setGender($gender): void
    {
        $this->gender = $gender;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setCountry($country): void
    {
        $this->country = $country;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCity($city): void
    {
        $this->city = $city;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }
}
