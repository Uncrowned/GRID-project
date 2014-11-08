using System;
using System.Threading;
using System.Net;
using System.IO;
using System.Windows;

namespace GRID1
{
    public class myThreads
    {
        static protected bool networkIsAlive = false;

        static protected string url = "http://www.google.ru";//url нашего сервера

        static protected string data="";

        static protected string task;

        public static void setTask(string value)
        {
            task = value;
        }

        public static string getTask()
        {
            return task;
        }

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

        public static void communicateProc()
        {
            string serverAnswer;
            //Этот поток разработан для "общения" с сервером
            while (true)
            {
                //Отправляем запрос серверу по адресу url с параметрами, хранящимися в переменной data
                try
                {
                    //Сначала надо коннект проверить)
                    //Если сеть не подключена сообщаем об этом пользователю и
                    //прерываем поток, отвечающий за связь с сервером
                    if (System.Net.NetworkInformation.NetworkInterface.GetIsNetworkAvailable())
                    {
                        //Если с сетью соединиться удалось, то устанавливаем соответствующий флаг
                        networkIsAlive = true;
                    }
                    else
                    {
                        MessageBox.Show("Network isn't connected! Try again later");
                        networkIsAlive = false;
                        Thread.CurrentThread.Abort();
                    }
                    serverAnswer=GET(url, data);
                    setTask(serverAnswer);
                    //Здесь надо вызвать метод(-ы) для расшифровки ответа сервера из класса parseTask
                }
                catch
                {
                    //Если главная форма приложения не закрыта, то значит возникла
                    //ошибка при "общении" с сервером.
                    if ((MainWindow.getFormAlive() == true)&&(networkIsAlive==true))
                    {
                        MessageBox.Show("Incorrect server answer");
                    }
                    //Если главная форма закрыта или прервано соединение с сетью, то это не ошибка, а
                    //несогласованность в работе потоков. Реагировать на возникшее исклчение в этом случае не надо.
                    //Просто уступаем ресурсы диспетеру потоков, чтобы основной поток завершил все остальные.
                    else
                    {
                        Thread.Yield();
                    }
                }
                //Поток "спит" время, определённое переменной requestInterval
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
