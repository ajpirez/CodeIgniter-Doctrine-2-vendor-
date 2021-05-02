<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 *
 * @Entity
 * @Table(name="type")
 * @author  Joseph Wynn <joseph@wildlyinaccurate.com>
 */
class Type
{

    /**
     * @Id
     * @Column(name="id", type="integer", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    public  $id;

    /**
     * @Column(name="nombre",type="string", length=200, nullable=false)
     */
    public  $nombre;

     /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Type
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }
}
