using System;
using System.IO;
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

            //WebRequest request = WebRequest.Create(@"http://newSite/");

            //request.Credentials = CredentialCache.DefaultCredentials;

            //try
            //{
            //    HttpWebResponse response = (HttpWebResponse)request.GetResponse();

            //    Stream dataStream = response.GetResponseStream();

            //    StreamReader reader = new StreamReader(dataStream);

            //    string responseFromServer = reader.ReadToEnd();

            //    textBox1.Text += responseFromServer;

            //    reader.Close();
            //    response.Close();

            //}
            //catch (Exception ex)
            //{
            //    textBox1.Text = ex.ToString();

            //}
            textBox1.Text = POST("http://newSite/", "a=1&b=2");
        }

        private string POST(string Url, string Data)
        {
          WebRequest req = WebRequest.Create(Url);
          req.Method = "POST";
          req.Timeout = 100000;
          req.ContentType = "application/x-www-form-urlencoded";
          byte[] sentData = Encoding.GetEncoding(1251).GetBytes(Data);
          req.ContentLength = sentData.Length;
          Stream sendStream = req.GetRequestStream();
          sendStream.Write(sentData, 0, sentData.Length);
          sendStream.Close();
          /*WebResponse res = req.GetResponse();
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
          }*/
          return "";
        }
    }
}
