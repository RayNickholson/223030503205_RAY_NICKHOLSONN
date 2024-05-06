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
      'initials': 'MM',
      'name': 'Marsianina Mega',
      'subject': 'Teknik Informatika',
    },

    {
      'initials': 'IK',
      'name': 'Ikhwan Koto',
      'subject': 'Sistem Informasi',
    },
    {
      'initials': 'PA',
      'name': 'Pake Arrayid',
      'subject': 'Fisika',
    },
    {
      'initials': 'RK',
      'name': 'Ryan Kimo',
      'subject': 'Olah Raga',
    },
    {
      'initials': 'AM',
      'name': 'Arif Mahran',
      'subject': 'Biologi',
    },
    {
      'initials': 'NH',
      'name': 'Nurrahman Hado',
      'subject': 'Sistem Komputer',
    },
    {
      'initials': 'AN',
      'name': 'Ade Nuri',
      'subject': 'Psikologi',
    },
    {
      'initials': 'FC',
      'name': 'Fitriani Chairi',
      'subject': 'Ilmu Komputer',
    },
    {
      'initials': 'EA',
      'name': 'Elsa Aprilio',
      'subject': 'Teknik Mesin',
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