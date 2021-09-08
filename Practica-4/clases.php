<?php

/**
 * Esta clase manipula la informacion de la clases de la escuela
 *
 * @author Uriel Tenorio <trainee.urielat@griver.com.mx>
 * @copyright 2021 RECO By SOFTDEM. All rights reserved.
 */
class Clase extends Conexion
{
	/**
	 * Insertar los datos de la clase
	 *
	 * Este metodo se encarga de insertar los id de profesor y materia, asi como su   * horario de clase
	 *
	 * @access public
	 * @param int $nIdProfesorInsertar
	 * @param int $nIdMateriaInsertar
	 * @param string $sHorarioInsertar
	 * @return string
	 */
	public function Insertar($nIdProfesorInsertar, $nIdMateriaInsertar, $sHorarioInsertar)
	{
		$oConexion = new Conexion;
		$db = $oConexion->Conectar();
		$consulta = $db
			->prepare("INSERT INTO clases (nIdProfesor,nIdMateria,sHorario) VALUES (?,?,?)");
		$consulta->bind_param("iis", $nIdProfesorBind, $nIdMateriaBind, $sHorarioBind);

		$nIdProfesorBind = $nIdProfesorInsertar;
		$nIdMateriaBind = $nIdMateriaInsertar;
		$sHorarioBind = $sHorarioInsertar;

		$consulta->execute();

		$consulta->close();
		$db->close();
		return 'Dato ingresado con exito';
	}

	/**
	 * Elimina los datos de la clase seleccionada. 
	 *
	 * Este metodo elimina los datos de una clase a partir de su id.
	 *
	 * @access public
	 * @param int $nIdSeleccionado
	 * @return string
	 */
	public function Eliminar($nIdSeleccionado)
	{
		$oConexion = new Conexion;
		$db = $oConexion->Conectar();
		$consulta = $db
			->prepare("DELETE FROM clases WHERE nIdClase = ?");
		$consulta->bind_param("i", $nIdCondicion);
		$nIdCondicion = $nIdSeleccionado;
		$consulta->execute();

		$consulta->close();
		$db->close();

		return 'Dato borrado';
	}

	/**
	 * Actualiza los datos de la clase.
	 *
	 * Este metodo recibe los id de los campos de la clase y actualiza los datos de   * acuerdo al id que es recibido.
	 *
	 * @access public
	 * @param int $nIdNombreActualizar
	 * @param int $nIdMateriaActualizar
	 * @param string $sHorarioActualizar
	 * @param int $nIdActualizar
	 * @return string 
	 * */
	public function Actualizar($nIdNombreActualizar, $nIdMateriaActualizar, $sHorarioActualizar, $nIdActualizar)
	{
		$oConexion = new Conexion;
		$db = $oConexion->Conectar();
		$consulta = $db
			->prepare("UPDATE clases 
								SET nIdProfesor = ?, nIdMateria=?, sHorario=? 
								WHERE nIdClase = ?");
		$consulta->bind_param("iisi", $nIdNombreSet, $nIdMateriaSet, $sHorarioSet, $nIdCondicion);

		$nIdNombreSet = $nIdNombreActualizar;
		$nIdMateriaSet = $nIdMateriaActualizar;
		$sHorarioSet = $sHorarioActualizar;
		$nIdCondicion = $nIdActualizar;

		$consulta->execute();

		$consulta->close();
		$db->close();
		return 'Dato actualizado con exito';
	}

	/**
	 * Obtiene los datos de una materia.
	 *
	 * Este metodo obtiene los nombres de profesores y maestros, ademas del horario
	 * de clase, de acuerdo al id que es obtenido.
	 *
	 * @access public
	 * @param int $nIdSeleccionado
	 * @return array
	 */
	public function UnRegistro($nIdSeleccionado)
	{
		$oConexion = new Conexion();
		$db = $oConexion->Conectar();
		$consulta = $db
			->prepare("SELECT
                            a.nIdClase,
                            b.sNombre nombremaestro,
                            c.sNombre nombremateria,
                            a.sHorario
                        FROM
                                clases a
                                INNER JOIN profesores b ON a.nIdProfesor = b.nIdProfesor
                                INNER JOIN materias c ON a.nIdMateria = c.nIdMateria
                        WHERE a.nIdClase = ?;");

		$consulta->bind_param("i", $nIdCondicion);

		$nIdCondicion = $nIdSeleccionado;

		$consulta->execute();

		$consulta->bind_result($nIdResult, $sNombreResult, $sMateriaResult, $sHorarioResult);

		$aDatosResult = [];
		while ($consulta->fetch() != null) {
			$aDatosResult[] = $nIdResult;
			$aDatosResult[] = $sNombreResult;
			$aDatosResult[] = $sMateriaResult;
			$aDatosResult[] = $sHorarioResult;
		}

		return $aDatosResult;
	}

	/**
	 * Obtiene los datos de la clase.
	 *
	 * Este metodo obtiene el nombre de profesor y materia, ademas de su horario de
	 * todas las clase que estan agregadas a la tabla.
	 *
	 * @access public
	 * @return array
	 */
	public function TodosRegistros()
	{
		$oConexion = new Conexion;
		$sql = "SELECT
									a.nIdClase,
									b.sNombre nombremaestro,
									c.sNombre nombremateria,
									a.sHorario
						FROM
						clases a
						INNER JOIN profesores b ON a.nIdProfesor = b.nIdProfesor
						INNER JOIN materias c ON a.nIdMateria = c.nIdMateria
						";
		$aDatosRegistros = $oConexion->ConsultaTodo($sql);
		return $aDatosRegistros;
	}
}
