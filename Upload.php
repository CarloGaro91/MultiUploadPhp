<?php 
// Classe per Recuperare il nome dei file Caricati
class Upload {

    public static function Carica_Img_Upload($Name_Img,$DirUpload){

        $Result = array();

        for ($i = 0; $i < count($_FILES[$Name_Img]['name']); $i++) {
        //Recupero il percorso temporaneo del file
            $userfile_tmp = $_FILES[$Name_Img]['tmp_name'][$i];

            if(!empty($userfile_tmp)){

                //recupero il nome originale del file caricato
                $userfile_name = basename($_FILES[$Name_Img]['name'][$i]);
                $userfile_name = preg_replace("/\s+/","_",$userfile_name);
                $userfile_ext = pathinfo($userfile_name,PATHINFO_EXTENSION);
                $userfile_ext = strtolower($userfile_ext);// Conveto tutto in Minusco per semplificare il controllo
                $userfile_name = pathinfo($userfile_name,PATHINFO_FILENAME);
                $final_name = rand(0,1000) . "_" . time() . date('Y-m-d') . "." . $userfile_ext;

                // Contro l'estensione del file.
                if($userfile_ext == 'jpg' || $userfile_ext == 'png' || $userfile_ext == 'jepg' ){
                    move_uploaded_file($userfile_tmp, $DirUpload . $final_name);
                    $Result[] =  $final_name ;
                }else{
                   $Result[] =  'Err' . $i;
                }
            }
        }
        return $Result;

    }
}
?>
