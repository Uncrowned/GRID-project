using System;
using System.Collections.Generic;
using System.Text;
using System.Windows;
using System.Windows.Input;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Shapes;
using System.Threading;
using System.IO;

namespace GRID1
{
	/// <summary>
	/// Interaction logic for MainWindow.xaml
	/// </summary>
	public partial class MainWindow : Window
	{
        //Это переменная флаг, используется для того, чтобы обозначать текущее состояние формы.
        //Она используется для того чтобы другие потоки приложения могли в любой момент
        //времени узнать текущее состояние формы (открыта/закрыта).
        static protected bool formAlive = true;

        public static void setFormAlive(bool value)
        {
            formAlive = value;
        }

        public static bool getFormAlive()
        {
            return formAlive;
        }

        public Thread calculationThread;
        public Thread communicateThread;

		public MainWindow()
		{
			this.InitializeComponent();
            setFormAlive(true);

            calculationThread = new Thread(new ThreadStart(myThreads.calculatingProc));
            communicateThread = new Thread(new ThreadStart(myThreads.communicateProc));
            communicateThread.Start();
            calculationThread.Start();
            Thread.Yield();
		}

        protected override void OnClosed(EventArgs e)
        {
            setFormAlive(false);
            base.OnClosed(e);
            calculationThread.Abort();
            communicateThread.Abort();
        }
	}
}