using System;
using System.Net;
using System.Text;
using System.IO;

namespace ClientDisp
{
	class Program
	{
		public static void Main(string[] args)
		{
			Console.WriteLine("Start point of ClientDisp");
			
			Console.Write("Press any key to continue . . . ");
			Console.ReadKey(true);
		}
		
		public void SendTask(string url)
        {
            string boundary = "----------" + DateTime.Now.Ticks.ToString("x");
            
            HttpWebRequest request = (HttpWebRequest)WebRequest.Create(url);
            request.ContentType = @"text/xml;charset=""utf-8""";
            request.Method = "POST";
            request.KeepAlive = true;
            request.ContentType = "multipart/form-data; boundary=" + boundary;
 
            System.Text.StringBuilder taskText = new StringBuilder();
            taskText.AppendLine(boundary);
            taskText.AppendLine("Content-Disposition:form-data; name=\"taskText\"");
            //
            taskText.AppendLine();

            
   
            taskText.AppendLine();
            taskText.AppendLine(boundary);
            byte[] message = Encoding.UTF8.GetBytes(taskText.ToString());
            using (Stream requestStream = request.GetRequestStream())
            {
                requestStream.Write(message, 0, message.Length);
                requestStream.Close();
            }
           
        }


	}
}