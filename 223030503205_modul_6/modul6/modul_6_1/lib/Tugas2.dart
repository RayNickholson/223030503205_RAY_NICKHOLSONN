import 'package:flutter/material.dart';

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Buat Website dalam 7 Menit',
      theme: ThemeData(
        primarySwatch: Colors.blue,
      ),
      home: MyHomePage(),
    );
  }
}

class MyHomePage extends StatefulWidget {
  @override
  _MyHomePageState createState() => _MyHomePageState();
}

class _MyHomePageState extends State<MyHomePage> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SingleChildScrollView(
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: <Widget>[
            Padding(
              padding: const EdgeInsets.all(16.0), // Menambahkan padding di sekitar gambar
              child: ClipRRect(
                borderRadius: BorderRadius.circular(16.0), // Batas sudut melengkung
                child: Image.asset(
                  'images/rayy.jpg',
                  fit: BoxFit.cover,
                  height: 200, // Tinggi gambar
                  width: double.infinity, // Lebar gambar, tetapi dibatasi oleh padding
                ),
              ),
            ),
            const Padding(
              padding: EdgeInsets.all(16.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    '11 Oktober 2022, 15:30 WIB',
                    style: TextStyle(
                      fontSize: 14.0,
                      color: Colors.grey,
                    ),
                  ),
                  SizedBox(height: 8.0),
                  Text(
                    'Buat Website hanya 7 menit dengan plugin ini!',
                    style: TextStyle(
                      fontSize: 24.0,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  SizedBox(height: 16.0),
                  Text(
                    'Sekarang buat website cukup hitungan menit saja. Kami akan memandu Anda dengan langkah-langkah yang lengkap dan mudah diikuti, tanpa perlu khawatir tentang coding atau hal teknis lainnya.',
                    style: TextStyle(
                      fontSize: 16.0,
                    ),
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}
