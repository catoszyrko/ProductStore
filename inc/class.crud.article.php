<?php
	class ARTICLE{

        var $nombre; 
        var $sku; 
        var $marca; 
        var $costo; 
         
		public function read($link){
			$sql = "SELECT * FROM article";
            $sq = mysqli_query($link,$sql);
    		return $sq;
    	}

		public function find($link, $id){
			$id = mysqli_real_escape_string($link, $id);
			$sql = "SELECT * FROM article WHERE id = '$id' ";
			$sq = mysqli_query($link,$sql);
			$s = mysqli_fetch_array($sq);
            return $s;
    	}
		
		public function delete($link, $id){
			$id = mysqli_real_escape_string($link, $id);
			$sql = "DELETE FROM article WHERE id = '$id' ";
			$link->query($sql);
            
		}

		public function create($link, $nombre, $sku, $marca, $costo, $categoria, $detail_1, $detail_2){
            $sql = "INSERT INTO article (nombre,sku, marca, costo, categoria, detail_1, detail_2) values ('$nombre', '$sku', '$marca', '$costo', '$categoria', '$detail_1', '$detail_2') ";
            $link->query($sql);
            
		}

		public function update($link, $nombre, $sku, $marca, $costo, $id, $categoria, $detail_1, $detail_2){
    		$sql = "UPDATE article SET nombre = '$nombre', marca = '$marca', sku = '$sku', costo = '$costo', categoria = '$categoria', detail_1 = '$detail_1', detail_2 = '$detail_2'  WHERE id = '$id' ";
            $link->query($sql);

		}


        // global function for price 
        public function price($type, $costo){
            switch($type){
                case 'televisor':
                    $televisor = new televisor;
                    $precio = $televisor->precio($costo);
                break;
                case 'zapato':
                    $zapato = new zapato;
                    $precio = $zapato->precio($costo);
                break;
                case 'laptop':
                    $laptop = new laptop;
                    $precio = $laptop->precio($costo);
                break;

            }
            return $precio;
        }
		
	}

    // subclasses 
    
    class televisor extends ARTICLE{
        public $precio;
        public function precio($costo){
            $precio = $costo*1.35;
            return $precio;
        }
    }
    
    class zapato extends ARTICLE{
        public $precio;
        public function precio($costo){
            $precio = $costo*1.30;
            return $precio;
        }
    }

    class laptop extends ARTICLE{
        public $precio;
        public function precio($costo){
            $precio = $costo*1.40;
            return $precio;
        }
    }

?>