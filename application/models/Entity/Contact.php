<?php

namespace Entity;

use Doctrine\Entity;


/**
 *
 * @Entity
 * @Table(name="contact")
 * @author  Joseph Wynn <joseph@wildlyinaccurate.com>
 */
class Contact
{

	/**
	 * @Id
	 * @Column(type="integer", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
    public  $id;

	/**
	 * @Column(type="string", length=200, unique=true, nullable=false)
	 */
    public  $nombre;


    /**
     * @OneToOne(targetEntity="type")
     * @JoinColumn(name="type_id", referencedColumnName="id")
     */
    public $type;


    /**
	 * @Column(type="integer", length=11, nullable=false)
	 */
    public  $phone;

	/**
	 * @Column(type="datetime", nullable=false)
	 */
    public  $dob;

	/**
     * @Column(type="string", length=1000, nullable=false)
	 */
    public  $description;




	public function setContactType($id)
	{
		$this->type = $id;
        return $this;
	}


	public function setNombre($nombre)
	{
		$this->nombre = $nombre;
		return $this;
	}

	public function setPhone($phone)
	{
		$this->phone = $phone;
		return $this;
	}

    public function setDob($dob)
    {
        $this->dob = $dob;
        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

	public function getId()
	{
		return $this->id;
	}

	public function getNombre()
	{
		return $this->nombre;
	}

    public function getContactType()
    {
        return $this->type;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getDob()
    {
        return $this->dob;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
