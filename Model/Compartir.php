<?php
class Compartir
{
    private $id,$id_usuario,$id_usuario_compartir,$id_archivo;

    function __construct($id,$id_usuario,$id_usuario_compartir,$id_archivo)
    {
        $this->id=$id;
        $this->id_usuario=$id_usuario;
        $this->id_usuario_compartir=$id_usuario_compartir;
        $this->id_archivo=$id_archivo;
    }


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id_usuario
     */ 
    public function getId_usuario()
    {
        return $this->id_usuario;
    }

    /**
     * Set the value of id_usuario
     *
     * @return  self
     */ 
    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }

    /**
     * Get the value of id_usuario_compartir
     */ 
    public function getId_usuario_compartir()
    {
        return $this->id_usuario_compartir;
    }

    /**
     * Set the value of id_usuario_compartir
     *
     * @return  self
     */ 
    public function setId_usuario_compartir($id_usuario_compartir)
    {
        $this->id_usuario_compartir = $id_usuario_compartir;

        return $this;
    }

    /**
     * Get the value of id_archivo
     */ 
    public function getId_archivo()
    {
        return $this->id_archivo;
    }

    /**
     * Set the value of id_archivo
     *
     * @return  self
     */ 
    public function setId_archivo($id_archivo)
    {
        $this->id_archivo = $id_archivo;

        return $this;
    }
}
