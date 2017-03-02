<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
//untuk mengetahui bulan bulan
if ( ! function_exists('bulan'))
{
    function bulan($bln)
    {
        switch ($bln)
        {
            case 1:
                return "Jan";
                break;
            case 2:
                return "Feb";
                break;
            case 3:
                return "Mar";
                break;
            case 4:
                return "Apr";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Jun";
                break;
            case 7:
                return "Jul";
                break;
            case 8:
                return "Agu";
                break;
            case 9:
                return "Sep";
                break;
            case 10:
                return "Okt";
                break;
            case 11:
                return "Nov";
                break;
            case 12:
                return "Des";
                break;
        }
    }
}
 
//format tanggal yyyy-mm-dd
if ( ! function_exists('tgl_indo'))
{
    function tgl_indo($tgl)
    {
        $ubah = gmdate($tgl, time()+60*60*8);
        $pecah = explode("-",$ubah);  //memecah variabel berdasarkan -
        $tanggal = $pecah[2];
        $bulan = bulan($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal.' '.$bulan.' '.$tahun; //hasil akhir
    }
}
 
//format tanggal timestamp
if( ! function_exists('tgl_indo_timestamp')){
 
    function tgl_indo_timestamp($tgl)
    {
        $inttime=date('Y-m-d H:i:s',$tgl); //mengubah format menjadi tanggal biasa
        $tglBaru=explode(" ",$inttime); //memecah berdasarkan spaasi
         
        $tglBaru1=$tglBaru[0]; //mendapatkan variabel format yyyy-mm-dd
        $tglBaru2=$tglBaru[1]; //mendapatkan fotmat hh:ii:ss
        $tglBarua=explode("-",$tglBaru1); //lalu memecah variabel berdasarkan -
     
        $tgl=$tglBarua[2];
        $bln=$tglBarua[1];
        $thn=$tglBarua[0];
     
        $bln=bulan($bln); //mengganti bulan angka menjadi text dari fungsi bulan
        $ubahTanggal="$tgl $bln $thn | $tglBaru2 "; //hasil akhir tanggal
     
        return $ubahTanggal;
    }
}
if( ! function_exists('tgl_indo_time')){
 
    function tgl_indo_time($tgl)
    {
        $tglBaru=explode(" ",$tgl); //memecah berdasarkan spaasi
         
        $tglBaru1=$tglBaru[0]; //mendapatkan variabel format yyyy-mm-dd
        $tglBaru2=$tglBaru[1]; //mendapatkan fotmat hh:ii:ss
        $tglBarua=explode("-",$tglBaru1); //lalu memecah variabel berdasarkan -
     
        $tgl=$tglBarua[2];
        $bln=$tglBarua[1];
        $thn=$tglBarua[0];
     
        $bln=bulan($bln); //mengganti bulan angka menjadi text dari fungsi bulan
        $ubahTanggal="$tgl $bln $thn <br> $tglBaru2 "; //hasil akhir tanggal
     
        return $ubahTanggal;
    }
}
if( ! function_exists('tgl_indo_time1')){
 
    function tgl_indo_time1($tgl)
    {
        $tglBaru=explode(" ",$tgl); //memecah berdasarkan spaasi
         
        $tglBaru1=$tglBaru[0]; //mendapatkan variabel format yyyy-mm-dd
        $tglBaru2=$tglBaru[1]; //mendapatkan fotmat hh:ii:ss
        $tglBarua=explode("-",$tglBaru1); //lalu memecah variabel berdasarkan -
     
        $tgl=$tglBarua[2];
        $bln=$tglBarua[1];
        $thn=$tglBarua[0];
     
        $bln=bulan($bln); //mengganti bulan angka menjadi text dari fungsi bulan
        $ubahTanggal="$tgl $bln $thn | $tglBaru2 "; //hasil akhir tanggal
     
        return $ubahTanggal;
    }
}

if( ! function_exists('addDate')){

    function addDate($vardate,$added)
    {
    $data = explode("-", $vardate);
    $date = new DateTime();
    $date->setDate($data[0], $data[1], $data[2]);
    $date->modify("".$added."");
    $day= $date->format("Y-m-d");
    return $day;
    }

    //echo "Example : " . adddate("2010-01-01","+365 day");

    //--hasil----  Example : 2010-08-02
}

if( ! function_exists('isiSingkat')){

    function isiSingkat($isi)
    {
        $isisingkat = ""; 
         $isi1 = substr($isi,0,300); 
         $isi2 = explode(" ",substr($isi,300,100)); 
         $isi = $isi1.$isi2[0]." ..."; 
         $isisingkat = $isi; 
         return $isisingkat; 
    }
}

if (!function_exists('dateInIntervalFormat')) {
	function dateInIntervalFormat($date, $interval, $format = 'Y-m-d')
	{
		$date = date_create($date);
		date_add($date, date_interval_create_from_date_string($interval .' days'));
		
		return date_format($date, $format);
	}
}