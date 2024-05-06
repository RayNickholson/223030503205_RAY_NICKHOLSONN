import 'package:flutter/material.dart';

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'ListView Builder',
      home: MyHomePage(),
    );
  }
}

class MyHomePage extends StatefulWidget {
  @override
  _MyHomePageState createState() => _MyHomePageState();
}

class _MyHomePageState extends State<MyHomePage> {
  final List<Map<String, String>> _data = [
    {
      'initials': 'RN',
      'name': 'Ray Nickholson',
      'subject': 'Teknik Informatika',
    },

    {
      'initials': 'JK',
      'name': 'Joko Putra',
      'subject': 'Sistem Informasi',
    },
    {
      'initials': 'CW',
      'name': 'Calvin Winata',
      'subject': 'Fisika',
    },
    {
      'initials': 'RG',
      'name': 'Resto Gunawan',
      'subject': 'Olah Raga',
    },
    {
      'initials': 'AR',
      'name': 'Aldo Revaldo',
      'subject': 'Biologi',
    },
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Tugas 1'),
      ),
      body: ListView.builder(
        itemCount: _data.length,
        itemBuilder: (context, index) {
          final item = _data[index];

          return ListTile(
            leading: Container(
              width: 40.0,
              height: 40.0,
              decoration: BoxDecoration(
                shape: BoxShape.circle,
                color: Colors.blue,
              ),
              child: Center(
                child: Text(
                  item['initials'] ?? '',
                  style: TextStyle(
                    color: Colors.white,
                    fontWeight: FontWeight.bold,
                  ),
                ),
              ),
            ),
            title: Text(
              item['name'] ?? '',
              style: TextStyle(
                fontSize: 16.0,
                fontWeight: FontWeight.bold,
              ),
            ),
            subtitle: Text(
              item['subject'] ?? '',
              style: TextStyle(
                fontSize: 14.0,
              ),
            ),
          );
        },
      ),
    );
  }
}