using System;
using System.Threading;
using System.Net;
using System.IO;
using System.Windows;

namespace GRID1
{
    public class myThreads
    {
        static protected int requestInterval = 0;

        public static void setRequestInterval(int value)
        {
            if (value >= 0)
            {
                requestInterval = value;
            }
            else
            {
                throw new System.ArgumentException("Parameter can not be smaller than 0");
            }
        }

        public static int getRequestInterval()
        {
            return requestInterval;
        }

        static protected string task;

        public static void setTask(string value)
        {
            task = value;
        }

        public static string getTask()
        {
            return task;
        }

        public static void communicateProc()
        {
            string serverAnswer;
            //This thread is designed to communicate with the server
            while (true)
            {
                //Sending requests to server
                
                //Processing the information received
                try
                {
                    //Сначала надо коннект проверить)
                    serverAnswer=GET("http://www.yandex.ru","");
                    setTask(serverAnswer);
                }
                catch
                {
                    MessageBox.Show("Incorrect server answer");
                }
                //The thread is sleeping a specified by requestInterval variable time
                Thread.Sleep(requestInterval);
            }
        }

        public static void calculatingProc()
        {
            //There is calculating procedure
        }

        public static string GET(string Url, string Data)
        {
            WebRequest req = WebRequest.Create(Url + "?" + Data);
            WebResponse resp = req.GetResponse();
            Stream stream = resp.GetResponseStream();
            StreamReader sr = new StreamReader(stream);
            string Out = sr.ReadToEnd();
            sr.Close();
            return Out;
        }
    }
}
