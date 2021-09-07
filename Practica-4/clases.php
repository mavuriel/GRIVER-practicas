<?php
class Clase extends Conexion
{
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
