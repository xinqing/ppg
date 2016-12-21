<?php
	//Lite Logger for php
	class MyLog
	{		
		static private $dir = "./log";
		static private $filename = "%s_%s.log";
		static private $format = ",";

		//设置日志路径
		static public function SetDir( $dir )
		{
			self::$dir = $dir;
		}
				
		//设置日志文件名(不用带路径)
		static public function SetFileName( $filename )
		{
			self::$filename = $filename;			
		}
		
		//设置分隔符
		static public function SetSeparate( $format )
		{
			self::$format = $format;
		}

	
		//写日志(日志内容强制数组)
		//eg.
		//
		//	MyLog::WriteArray( array( "test", "value" ) );
		//
		static public function WriteArray( $arrLog )
		{
			$arrLog = (array)$arrLog;
			$logTime = (string)date('Y_m_d_G');
			//$fileFormat = "%s_%s.log";
			$arrLog['DATE'] = date( 'Y-m-d G:i:s' );
			$arrLog['IP'] = $_SERVER['REMOTE_ADDR'];
			$fileType = $arrLog[0]."log";
			$filename = sprintf(self::$filename,$fileType,$logTime);
			switch( $format )
			{
			case 'json':
				$content = json_encode( $arrLog );
				break;
			case 'str':
				$content = var_export( $arrLog, true );
				break;				
			default:
				$content = implode( self::$format, $arrLog );
				break;
			}

			$file = self::$dir . '/' . $filename;	

			if(!file_exists(self::$dir))
			{
				mkdir(self::$dir,0700);
			}
			
			@file_put_contents( $file, $content . "\r\n", FILE_APPEND );
		}
		
		static public function WriteFixFileNameArray( $arrLog )
		{
			if(!is_array($arrLog) || count($arrLog) < 2)
				return;
			$filename = $arrLog[0];

			$file = self::$dir . '/' . $filename;	

			if(!file_exists(self::$dir))
			{
				mkdir(self::$dir,0700);
			}
			
			@file_put_contents( $file, $arrLog[1], FILE_APPEND );
		}
		
		
		//写日志(日志内容不定长)
		//eg.
		//
		//	MyLog::WriteArg( "test", "value" );
		//
		static public function WriteArg()
		{
			$arrArg = func_get_args();
			self::WriteArray( $arrArg );
		}
		
		static public function WriteFixFileNameArg()//固定文件名的打印
		{
			$arrArg = func_get_args();
			self::WriteFixFileNameArray( $arrArg );
		}
		
		//读日志
		//	My
		static public function ReadLog( $format='|' )
		{
			$file = self::$dir . '/'.self::$filename;
			$lines = file($file);
			$arrLine = array();
			foreach ($lines as $line) 
			{ 
				$arrLine[] = explode ($format, $line );
			} 
			self::$dir = false;
			return $arrLine;
		}
	}