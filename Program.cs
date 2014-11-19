using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Xml;
using System.Net;
using System.IO;
using System.Reflection;


namespace _2
{
    class Program
    {

        string GET(string Url, string Data)
        {
            WebRequest req = WebRequest.Create(Url + "?" + Data);
            WebResponse resp = req.GetResponse();
            Stream stream = resp.GetResponseStream();
            StreamReader sr = new StreamReader(stream);
            string Out = sr.ReadToEnd();
            sr.Close();
            return Out;
        }

        static void getstateXml(string path)
        {
            Dictionary<string, string> ret;
            var doc = new XmlDocument();
            {
                try
                {
                    doc.Load(path);
                    //doc.LoadXml(path);

                    //foreach (var node in doc.) //SelectNodes("response"))
                    //{
                    //    ret.Add()
                    //}
                }
                catch (XmlException e)
                {
                    Console.WriteLine("Ошибка XML: {0}", e.Message);
                }
                catch (IOException e)
                {
                    Console.WriteLine("Ошибка: {0}", e.Message);
                }
            }
        }

        static void printhelp()
        {
            Console.WriteLine("\n exit     - выход");
            Console.WriteLine(" getstate - запрос состояния узлов");
            Console.WriteLine(" gettasks - запрос заданий узлов");
            Console.WriteLine(" help     - помощь\n");

        }

        static Dictionary<string, string> JsonDownload(string path)
        {
            try
            {
                Dictionary<string, string> ret = new Dictionary<string, string>();
                string text = null;
                //text=GET(string Url, string Data);
                StreamReader sr = new StreamReader(path);
                text = sr.ReadToEnd();
                ret = json2dict.ParseJson(text);
                sr.Close();
                return ret;
            }
            catch (IOException e)
            {
                Console.WriteLine(" Ошибка: {0}", e.Message);
                return null;
            }
        }

        static void getstate(Dictionary<string, string> inpairs)
        {
            Dictionary<string, string> pairs = inpairs;
            Console.WriteLine();
            foreach (var i in pairs)
            {
                if (i.Key.Contains("availability") && i.Key.Contains("node"))
                    Console.WriteLine(" " + i.Key + " " + i.Value);
            }
            Console.WriteLine();
        }

        static void gettasks(Dictionary<string, string> inpairs)
        {
            Dictionary<string, string> pairs = inpairs;
            Console.WriteLine();
            foreach (var i in pairs)
            {
                if (i.Key.Contains("task") && i.Key.Contains("node"))
                    Console.WriteLine(" " + i.Key + " " + i.Value);
            }
            Console.WriteLine();
        }


        static void Main(string[] args)
        {
            string comand;
            ConsoleColor def = Console.ForegroundColor;
            Console.ForegroundColor = ConsoleColor.DarkGreen;
            Console.WriteLine("\n ******************************************************************************");
            Console.WriteLine("                                  Привет Мир!");
            Console.WriteLine("                              Помощь - help или ?");
            Console.WriteLine(" ******************************************************************************\n");

            do
            {
                Console.Write(" client-console $  ");
                comand = Console.ReadLine().Trim().ToLower();
                switch (comand)
                {
                    case "getstate": getstate(JsonDownload(Path.GetDirectoryName(Assembly.GetExecutingAssembly().Location) + "\\state.json"));
                        //getstateXml(Path.GetDirectoryName(Assembly.GetExecutingAssembly().Location) + "\\state.xml");
                        break;
                    case "gettasks": gettasks(JsonDownload(Path.GetDirectoryName(Assembly.GetExecutingAssembly().Location) + "\\state.json"));
                        break;
                    case "help":
                    case "Help":
                    case "?": printhelp();
                        break;
                    case "": break;
                    case "exit":
                    case "q":
                    case "Q":
                    case "Exit": break;
                    default:
                        Console.WriteLine(" Неверная команда");
                        break;
                }
            }
            while (comand != "exit" && comand != "Exit" && comand != "q" && comand != "Q");
            Console.ForegroundColor = def;
        }
    }
}
