using System;
using System.IO;
using System.Net;
using System.Windows.Forms;

namespace Storage
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();

            WebRequest request = WebRequest.Create(@"http://server.serv/index2.php");

            request.Credentials = CredentialCache.DefaultCredentials;

            try
            {
                HttpWebResponse response = (HttpWebResponse)request.GetResponse();

                Stream dataStream = response.GetResponseStream();

                StreamReader reader = new StreamReader(dataStream);

                string responseFromServer = reader.ReadToEnd();

                textBox1.Text += responseFromServer;

                reader.Close();
                response.Close();

            }
            catch (Exception ex)
            {
                textBox1.Text = ex.ToString();

            }
        }
    }
}
