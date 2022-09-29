<?php
class Archivos
{
    private $id,$codigo_usuario,$archivo,$extencion,$comentario;

    function __construct($id,$codigo_usuario,$archivo,$extencion,$comentario)
    {
        $this->id=$id;
        $this->codigo_usuario=$codigo_usuario;
        $this->archivo=$archivo;
        $this->extencion=$extencion;
        $this->comentario=$comentario;
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
     * Get the value of codigo_usuario
     */ 
    public function getcodigo_usuario()
    {
        return $this->codigo_usuario;
    }

    /**
     * Set the value of codigo_usuario
     *
     * @return  self
     */ 
    public function setcodigo_usuario($codigo_usuario)
    {
        $this->codigo_usuario = $codigo_usuario;

        return $this;
    }

        /**
         * Get the value of archivo
         */ 
        public function getArchivo()
        {
                return $this->archivo;
        }

        /**
         * Set the value of archivo
         *
         * @return  self
         */ 
        public function setArchivo($archivo)
        {
                $this->archivo = $archivo;

                return $this;
        }

        /**
         * Get the value of comentario
         */ 
        public function getComentario()
        {
                return $this->comentario;
        }

        /**
         * Set the value of comentario
         *
         * @return  self
         */ 
        public function setComentario($comentario)
        {
                $this->comentario = $comentario;

                return $this;
        }

    /**
     * Get the value of extencion
     */ 
    public function getExtencion()
    {
        return $this->extencion;
    }

    /**
     * Set the value of extencion
     *
     * @return  self
     */ 
    public function setExtencion($extencion)
    {
        $this->extencion = $extencion;

        return $this;
    }
}
