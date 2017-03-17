import java.io.File;
import java.text.SimpleDateFormat;

import java.util.Date;

import com.jcraft.jsch.*;


public class Connect2SFTP {
	
	static long startTime = System.currentTimeMillis();
    
    public static void send() throws Exception {
    	
        
        String SFTPHOST = "199.19.209.92";
        
        int SFTPPORT = 22;
        
        String SFTPUSER = "devaqdatastore";
        
        String SFTPPASS = "CTT3nsaRT*";
                
        Session session = null;
        
        Channel channel = null;
        
        ChannelSftp channelSftp = null;
        
        System.out.println("Preparing the host information for sftp.");
        
        try {
            
            JSch jsch = new JSch();
            
            session = jsch.getSession(SFTPUSER, SFTPHOST, SFTPPORT);
            
            session.setPassword(SFTPPASS);
            
            java.util.Properties config = new java.util.Properties();
            
            config.put("StrictHostKeyChecking", "no");
            
            session.setConfig(config);
            
            session.connect();
            
            System.out.println("Host connected.");
            
            channel = session.openChannel("sftp");
            
            channel.connect();
            
            System.out.println("sftp channel opened and connected.");
            
            channelSftp = (ChannelSftp) channel;
            
            //Date today = new Date();
            //String fileout="Auto_Quotes_Extract_"+ new SimpleDateFormat("yyyyMMdd").format(today);
            
            
            
            File folder = new File("C:/Work/TriMark/Project/Feb17/700");
            File[] files = folder.listFiles();
            
            for (File file : files){
                channelSftp.put(file.getAbsolutePath(), "devaqdatastore-AQJDEItems/media");
            }
            //channelSftp.put("test.txt", "devaqdatastore-AQJDEItems/Old files/"+fileout);


        } catch (Exception ex) {
            
            System.out.println("Exception found while tranfer the response.");
            
            throw new Exception();
            
        } finally {
            
            channelSftp.exit();
            
            System.out.println("sftp Channel exited.");
            
            channel.disconnect();
            
            System.out.println("Channel disconnected.");
            
            session.disconnect();
            
            System.out.println("Host Session disconnected.");
            
        }
        
    }
    public static void main(String[] args) throws Exception 
    {
        send();
        long endTime   = System.currentTimeMillis();
        long totalTime = endTime - startTime;
        double elapsedSeconds = totalTime / 1000.0;
        System.out.println(elapsedSeconds);
        //System.out.println(totalTime);
    }
   
}