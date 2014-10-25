using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Net;
using System.Windows.Forms;
using System.Text;

namespace Storage
{
    public partial class Form1 : Form
    {
        private int id;
        private int reservId = 0;

        public Form1()
        {
            InitializeComponent();
            timer1.Start();
            id = GET(@"http://yiiserver/index.php?r=storage&id=0");
        }

        private string POST(string Url, string patch, string fileName)
        {
            WebRequest req = WebRequest.Create(Url);
            req.Method = "POST";
            req.Timeout = 100000;
            req.ContentType = "application/x-www-form-urlencoded";

            var listarr = new List<byte>();
            byte[] sentData = Encoding.GetEncoding(1251).GetBytes("filename=" + fileName + "&");
            listarr = sentData.ToList();
            sentData = Encoding.GetEncoding(1251).GetBytes("file=");
            listarr.AddRange(sentData);
            sentData = File.ReadAllBytes(patch);
            listarr.AddRange(sentData);
            sentData = listarr.ToArray();

            req.ContentLength = sentData.Length;
            Stream sendStream = req.GetRequestStream();
            sendStream.Write(sentData, 0, sentData.Length);
            sendStream.Close();
            
            WebResponse res = req.GetResponse();
            Stream ReceiveStream = res.GetResponseStream();
            StreamReader sr = new StreamReader(ReceiveStream, Encoding.UTF8);
            Char[] read = new Char[256];
            int count = sr.Read(read, 0, 256);
            string Out = String.Empty;
            while (count > 0)
            {
                var str = new String(read, 0, count);
                Out += str;
                count = sr.Read(read, 0, 256);
            }
            return Out;
        }

        private void button1_Click(object sender, EventArgs e)
        {
            openFileDialog1.ShowDialog();
            if (openFileDialog1.FileName != null)
            {
                textBox1.Text = POST(
                    "http://yiiserver/index.php?r=storage/storage", openFileDialog1.FileName, openFileDialog1.SafeFileName
                    );
            }
        }

        private void button2_Click(object sender, EventArgs e)
        {
            //тут ниже в зависимости от того какой файл надо сохранить и как id у ноды будет генериться ссыль 		
            var responseFromServer = GET("http://server.serv/download.php?id="+id+"&filename=griffin-plachet_56957798_orig_.jpeg");
            
            textBox1.Text = responseFromServer.ToString();
            WebClient wc = new WebClient();
            Uri ui = new Uri(responseFromServer.ToString());
            string path =ui.Segments[2];
            textBox1.Text += "\r\n" + path;
            wc.DownloadFileAsync(ui, path);

        }
        /**
         *  отправка GET запроса
         *  возвращает ответ от сервера
         */
        private int GET(string url)
        {
            WebRequest request = WebRequest.Create(url);
            request.Credentials = CredentialCache.DefaultCredentials;
            HttpWebResponse response = (HttpWebResponse)request.GetResponse();
            Console.WriteLine(response.StatusDescription);
            Stream dataStream = response.GetResponseStream();
            StreamReader reader = new StreamReader(dataStream);
            string responseFromServer = reader.ReadToEnd();
            reader.Close();
            dataStream.Close();
            response.Close();
            return Convert.ToInt32(responseFromServer);
        }

        private void timer1_Tick(object sender, EventArgs e)
        {
            GET("http://yiiserver/index.php?r=storage&id="+id);
        }


    }
}
