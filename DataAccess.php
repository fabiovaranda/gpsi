<?php
class DataAccess{
    private $connection;
	
    function connect(){
        /*$bd= "curso_gpsi2";
        $user = "root";
        $pwd = "";
		*/
		$bd= "gpsipt_gpsi";
			$user = "gpsipt_admin";
			$pwd = "T1VEF]2%Wq6H";
        $server = "localhost";
		$this->connection = mysqli_connect($server,$user,$pwd,$bd);

		// Check connection
		if (mysqli_error($this->connection))
		{
			$bd= "gpsipt_gpsi";
			$user = "gpsipt_admin";
			$pwd = "T1VEF]2%Wq6H";
			$this->connection = mysqli_connect($server,$user,$pwd,$bd);
			if (mysqli_error($this->connection))
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}else{
				mysqli_query($this->connection, "set names 'utf8'");
				mysqli_query($this->connection, "set character_set_connection=utf8");
				mysqli_query($this->connection, "set character_set_client=utf8");
				mysqli_query($this->connection, "set character_set_results=utf8");
			}
		}else{
            mysqli_query($this->connection, "set names 'utf8'");
            mysqli_query($this->connection, "set character_set_connection=utf8");
            mysqli_query($this->connection, "set character_set_client=utf8");
            mysqli_query($this->connection, "set character_set_results=utf8");
        }
    }
    
    function execute($query){
        $res = mysqli_query($this->connection, $query);
        if(!$res){
            die("Comando inválido".mysqli_error($this->connection));
        }else
            return $res;
    }
    
    function disconnect(){
        mysqli_close($this->connection);
    }
	
	function login($email, $password){
        $query = "select * from utilizadores where email = '$email' and password = '$password'";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res;
    }
	
	function getdisciplinas(){
		$query = "select * from disciplinas order by nome asc";
		$this->connect();
		$res = $this->execute($query);
		$this->disconnect();
		return $res;
	}
	
	function getDisciplina($id){
		$query = "select * from disciplinas where id = $id";
		$this->connect();
		$res = $this->execute($query);
		$this->disconnect();
		return $res;
	}
	
	function inserirDescricaoDisciplina($descricao, $idDisciplina, $img)
	{
		$query = "update disciplinas set descricao = '$descricao', img = '$img' where id = $idDisciplina";
		$this->connect();
		$res = $this->execute($query);
		$this->disconnect();
	}
	
	public function inserirProfessor($nome, $email, $idTipoUtilizador){
		$pwd = md5('epbjcgpsi');
		$query = "insert into utilizadores(nome, email, password, idTipoUtilizador) values
										('$nome', '$email', '$pwd', '$idTipoUtilizador')";
		$this->connect();
		$this->execute($query);
		$id = $this->connection->insert_id;
		$this->disconnect();
		return $id;
	}
	
	public function apagarDisciplinaAProf($idProfessor){
		$query = "delete from utilizadores_disciplinas where idUtilizador = $idProfessor";
		$this->connect();
		$this->execute($query);
		$this->disconnect();
	}
	
	public function associarProfADisciplina($idProfessor, $idDisciplina){
		$query = "insert into utilizadores_disciplinas(idUtilizador, idDisciplina)
										       values ($idProfessor, $idDisciplina)";
		$this->connect();
		$this->execute($query);
		$this->disconnect();
	}
	
	function getUtilizadores(){
		$query = "select * from utilizadores order by nome asc";
		$this->connect();
		$res = $this->execute($query);
		$this->disconnect();
		return $res;
	}
	
	function eliminarUtilizadores($id){
		$query = "delete from utilizadores where id = ".$id;
		$this->connect();
		$res = $this->execute($query);
		$this->disconnect();
		return $res;
	}
	
	function getdisciplinasPorArea(){
		$query = "select d.id, d.nome, d.img, ad.area FROM disciplinas d inner join areasdisciplinas ad where ad.id = d.idArea order by d.idArea, d.nome";
		
		$this->connect();
		$res = $this->execute($query);
		$this->disconnect();
		return $res;
	}


	function editarDisciplina($nome, $descricao, $id){
		$query = "update disciplinas set nome = '".$nome."', descricao = '".$descricao."' where id = ".$id;
		$this->connect();
		$this->execute($query);
		$this->disconnect();
	}
	
	function eliminarDisciplina($id){
		$query = "delete from disciplinas where id = ".$id;
		$this->connect();
		$this->execute($query);
		$this->disconnect();
	}
	
	function editarUtilizador($nome,$email,$password,$id){
		$query = "update utilizadores set nome = '".$nome."', email = '".$email."', password = '".$password."' where id = ".$id;
		$this->connect();
		$this->execute($query);
		$this->disconnect();
	}
	
	function getUtilizador($id){
		$query = "select nome, email from utilizadores where id= ".$id;
		$this->connect();
		$res = $this->execute($query);
		$this->disconnect();
		return $res;
	}
	
	function inserirNoticia($titulo, $texto, $data, $video, $tags, $idUtilizador, $foto){
		$query = "insert into noticias(titulo, texto, data, video, tags, idUtilizador, foto) values
										('$titulo', '$texto', '$data', '$video', '$tags', '$idUtilizador', '$foto')";
		
		$this->connect();
		$this->execute($query);
		$id = $this->connection->insert_id;
		$this->disconnect();
		return $id;
	}
	
	function inserirFotoNoticia($idNoticia, $foto){
		$query = "insert into fotosnoticia(nome, idNoticia) values ('$foto', $idNoticia)";
		$this->connect();
		$this->execute($query);
		$this->disconnect();
	}
	
	function editarNoticia($titulo, $texto, $data, $foto, $video, $tags, $id){
		$query = "update noticias set titulo = '".$titulo."', texto = '".$texto."', data = '".$data."', foto = '".$foto."', 
									video = '".$video."', tags = '".$tags."' where id = ".$id;
		$this->connect();
		$this->execute($query);
		$this->disconnect();
	}
	
	function eliminarNoticia($id){
		$query = "delete from noticias where id = ".$id;
		$this->connect();
		$this->execute($query);
		$this->disconnect();
	}
	
	function getNoticias(){
		$query = "select * from noticias order by id desc";
		$this->connect();
		$res = $this->execute($query);
		$this->disconnect();
		return $res;
	}
	
	function getFotosNoticia($id){
		$query = "select * 	from fotosnoticia where idNoticia = $id order by id asc";
		$this->connect();
		$res = $this->execute($query);
		$this->disconnect();
		return $res;
	}
	
	function getNoticia($id){
		$query = "select titulo, texto, data, foto, video, tags from noticias where id= ".$id;
		$this->connect();
		$res = $this->execute($query);
		$this->disconnect();
		return $res;
	}
	
	function inserirModulo($numero, $nome, $descricao, $numHoras, $idDisciplina){
		$query = "insert into modulos(numero, nome, descricao, numHoras, idDisciplina) values
				  ('$numero', '$nome', '$descricao', '$numHoras', '$idDisciplina')";
		$this->connect();
		$this->execute($query);
		$id = $this->connection->insert_id;
		$this->disconnect();
	}
	
	function editarModulo($numero, $nome, $descricao, $numHoras, $id){
		$query = "update modulos set numero = '".$numero."', nome = '".$nome."', descricao = '".$descricao."', numHoras = '".$numHoras."' where id = ".$id;
		$this->connect();
		$this->execute($query);
		$this->disconnect();
	}
	
	function eliminarModulo($id){
		$query = "delete from modulos where id = ".$id;
		$this->connect();
		$this->execute($query);
		$this->disconnect();
	}
	
	function getModulos(){
		$query = "select * from modulos order by numero asc";
		$this->connect();
		$res = $this->execute($query);
		$this->disconnect();
		return $res;
	}
	
	function getModulo($id){
		$query = "select numero, nome, descricao, numHoras from modulos where id= ".$id;
		$this->connect();
		$res = $this->execute($query);
		$this->disconnect();
		return $res;
	}
	
	function getModulosDisciplina($id){
		$query = "select m.id, m.numero, m.nome, m.numHoras from modulos m where m.idDisciplina = ".$id." order by m.numero";
		$this->connect();
		$res = $this->execute($query);
		$this->disconnect();
		return $res;
	}
	
	//Ver se está certo
	function getModulosNome(){
		$query = "select m.id, m.numero, m.nome, m.descricao, m.numHoras from modulos m inner join modulosnome mn where mn.id = n.idNome order by n.idNome, n.nome";
		$this->connect();
		$res = $this->execute($query);
		$this->disconnect();
		return $res;
	}
	
	
	function inserirFicheiro($nome, $descricao, $ficheiro, $idModulo){
		$query = "insert into ficheiros(nome, descricao, ficheiro, idModulo) values
										('$nome', '$descricao', '$ficheiro', $idModulo)";
		$this->connect();
		$this->execute($query);
		$id = $this->connection->insert_id;
		$this->disconnect();
	}
	
	//Ver se está certo
	function eliminarFicheiro($id){
		$query = "delete from ficheiros where id = ".$id;
		$this->connect();
		$this->execute($query);
		$this->disconnect();
	}
	
	//Ver se está certo
	function getFicheiro($id){
		$query = "select nome, ficheiro, descricao from ficheiros where id= ".$id;
		$this->connect();
		$res = $this->execute($query);
		$this->disconnect();
		return $res;
	}
	
	
	function getFicheirosModulo($id){
		$query = "select * from ficheiros where idModulo = ".$id." order by id asc";
		$this->connect();
		$res = $this->execute($query);
		$this->disconnect();
		return $res;
	}
	
	function getTiposUtilizador(){
		$query = "select * from tiposutilizadores";
		$this->connect();
		$res = $this->execute($query);
		$this->disconnect();
		return $res;
	}
	
	function pesquisarUtilizadorPorTexto($texto){
		$query = "select * from utilizadores where nome like '%$texto%' or email like '%$texto%' ";
        $this->connect();
        $res = $this->execute($query);
        $this->disconnect();
        return $res;
	}
	
	function pesquisardisciplinasPorTexto($texto){
		$query = "select * from disciplinas d where d.nome like '%$texto%'";
		$this->connect();
		$res = $this->execute($query);
		$this->disconnect();
		return $res;
	}
	
	function pesquisarModulosPorTexto($texto){
		$query = "select * from modulos m where m.numero like '%$texto%' or m.nome like '%$texto%' or m.descricao like '%$texto%' ";
		$this->connect();
		$res = $this->execute($query);
		$this->disconnect();
		return $res;
	}
	
	function pesquisarNoticiasPorTexto($texto){
		$query = "select * from noticias n where n.titulo like '%$texto%' or n.texto like '%$texto%' or n.data like '%$texto%' 
		or n.tags like '%$texto%'";
		$this->connect();
		$res = $this->execute($query);
		$this->disconnect();
		return $res;
	}
}
?>