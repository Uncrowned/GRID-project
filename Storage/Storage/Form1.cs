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
        public Form1()
        {
            InitializeComponent();

        }

        private string POST(string Url, string patch, string fileName)
        {
            WebRequest req = WebRequest.Create(Url);
            req.Method = "POST";
            req.Timeout = 100000;
            req.ContentType = "application/x-www-form-urlencoded";

            var listarr = new List<byte>();
            byte[] sentData = Encoding.GetEncoding(1251).GetBytes("filename="+fileName+"&");
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
            //Кодировка указывается в зависимости от кодировки ответа сервера
            Char[] read = new Char[256];
            int count = sr.Read(read, 0, 256);
            string Out = String.Empty;
            while (count > 0)
            {
              String str = new String(read, 0, count);
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
                textBox1.Text = POST("http://server.serv/", openFileDialog1.FileName, openFileDialog1.SafeFileName);
            }            
        }


    }
}
