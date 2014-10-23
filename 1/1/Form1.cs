using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Net;
using System.IO;
using System.Xml;

namespace _1
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

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

        void parcer()
        {
            var doc = new XmlDocument();
            {
                string path = Application.StartupPath + "\\answer.xml";
                doc.Load(path);
                //doc.LoadXml("<?xml version=\"1.0\" encoding=\"utf-8\"?>");
                foreach (XmlNode node in doc.DocumentElement)
                {
                    if (node.LocalName == "user_id")
                        textBox1.Text = "User id: " + (node.FirstChild == null ? "" : node.FirstChild.Value);
                    else if (node.LocalName == "user_name")
                        textBox2.Text = "User name: " + (node.FirstChild == null ? "" : node.FirstChild.Value);
                }
            }
        }

        private void button1_Click(object sender, EventArgs e)
        {
            parcer();
        }
    }
}
