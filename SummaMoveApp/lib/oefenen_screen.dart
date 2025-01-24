// oefenen_screen.dart
import 'package:flutter/material.dart';
import 'oefening.dart';
import 'api_service.dart';
import 'oefening_detail_screen.dart';

class OefenenScreen extends StatefulWidget {
  @override
  _OefenenScreenState createState() => _OefenenScreenState();
}

class _OefenenScreenState extends State<OefenenScreen> {
  late Future<List<Oefening>> oefeningen;

  @override
  void initState() {
    super.initState();
    oefeningen = ApiService().fetchOefeningen();  // Haal de oefeningen op via de API
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Oefeningen'),
      ),
      body: FutureBuilder<List<Oefening>>(
        future: oefeningen,
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return Center(child: CircularProgressIndicator());
          } else if (snapshot.hasError) {
            // Toon de foutmelding in de UI
            return Center(
              child: Text(
                'Error: ${snapshot.error}',
                style: TextStyle(color: Colors.red, fontWeight: FontWeight.bold),
              ),
            );
          } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
            return Center(child: Text('Geen oefeningen gevonden'));
          }

          var oefeningenData = snapshot.data!;

          return ListView.builder(
            itemCount: oefeningenData.length,
            itemBuilder: (context, index) {
              var oefening = oefeningenData[index];
              return ListTile(
                title: Text(oefening.name),
                onTap: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(
                      builder: (context) => OefeningDetailScreen(oefening: oefening),
                    ),
                  );
                },
              );
            },
          );
        },
      ),
    );
  }
  }
