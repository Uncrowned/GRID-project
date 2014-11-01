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
        public Thread calculationThread;
        public Thread communicateThread;

		public MainWindow()
		{
			this.InitializeComponent();

            calculationThread = new Thread(new ThreadStart(myThreads.calculatingProc));
            communicateThread = new Thread(new ThreadStart(myThreads.communicateProc));
            communicateThread.Start();
            calculationThread.Start();
		}

        protected override void OnClosed(EventArgs e)
        {
            base.OnClosed(e);
            calculationThread.Abort();
            communicateThread.Abort();
        }
	}
}