#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Script untuk generate diagram ERD dan UML sebagai file PNG
Menggunakan library graphviz dan Pillow
"""

import os
import subprocess
import sys

def check_dependencies():
    """Cek apakah Graphviz sudah terinstall"""
    try:
        result = subprocess.run(['dot', '-V'], capture_output=True, text=True)
        print(f"✅ Graphviz terdeteksi: {result.stderr.strip()}")
        return True
    except FileNotFoundError:
        print("❌ Graphviz tidak terinstall!")
        print("\n📥 Install Graphviz:")
        print("   Windows (chocolatey): choco install graphviz")
        print("   Windows (manual): Download dari https://graphviz.org/download/")
        print("   Linux (Ubuntu): sudo apt-get install graphviz")
        print("   macOS: brew install graphviz")
        return False

def create_erd_diagram():
    """Generate ERD (Class Diagram) sebagai PNG"""
    
    dot_code = """
digraph {
    rankdir=LR;
    node [shape=box, style=rounded];
    
    Authenticatable [label="<<abstract>>\\nAuthenticatable\\n\\n+ password: string\\n+ remember_token: string\\n\\n+ getAuthPassword()\\n+ getRememberToken()"];
    
    User [label="User\\n\\n- id: int <<PK>>\\n- name: string\\n- email: string <<UNIQUE>>\\n- email_verified_at: datetime\\n- password: string\\n- remember_token: string\\n- created_at: datetime\\n- updated_at: datetime\\n\\n+ create()\\n+ update()\\n+ delete()"];
    
    Student [label="Student\\n\\n- id: int <<PK>>\\n- name: string\\n- class_year: string\\n- major_interest: string\\n- bio: text\\n- photo: string\\n- created_at: datetime\\n- updated_at: datetime\\n\\n+ create()\\n+ read()\\n+ update()\\n+ delete()"];
    
    Funfact [label="Funfact\\n\\n- id: int <<PK>>\\n- slug: string <<UNIQUE>>\\n- title: string\\n- category: string\\n- summary: string\\n- img: string\\n- source: string\\n- author: string\\n- date: string\\n- content: text\\n- created_at: datetime\\n- updated_at: datetime\\n\\n+ create()\\n+ read()\\n+ update()\\n+ delete()"];
    
    FunfactFeedback [label="FunfactFeedback\\n\\n- id: int <<PK>>\\n- slug: string <<FK>>\\n- name: string\\n- comment: text\\n- rating: int (0-5)\\n- created_at: datetime\\n- updated_at: datetime\\n\\n+ create()\\n+ read()\\n+ update()\\n+ delete()"];
    
    Survey [label="Survey\\n\\n- id: int <<PK>>\\n- name: string\\n- email: string\\n- topic_interest: string\\n- reason: text\\n- expected_impact: text\\n- comments: text\\n- created_at: datetime\\n- updated_at: datetime\\n\\n+ create()\\n+ read()\\n+ update()\\n+ delete()"];
    
    User -> Authenticatable [label="extends"];
    Funfact -> FunfactFeedback [label="1:N"];
}
"""
    
    # Simpan dot file
    with open('temp_erd.dot', 'w') as f:
        f.write(dot_code)
    
    # Generate PNG
    try:
        subprocess.run(['dot', '-Tpng', 'temp_erd.dot', '-o', 'docs/erd.png'], check=True)
        print("✅ ERD diagram berhasil dibuat: docs/erd.png")
        os.remove('temp_erd.dot')
        return True
    except Exception as e:
        print(f"❌ Error membuat ERD: {e}")
        return False

def create_uml_diagram():
    """Generate UML Use Case Diagram sebagai PNG"""
    
    dot_code = """
digraph {
    rankdir=LR;
    node [shape=ellipse];
    
    Admin [shape=box, label="Admin"];
    User [shape=box, label="User"];
    
    CreateFunfact [label="Create Funfact"];
    UpdateFunfact [label="Update Funfact"];
    DeleteFunfact [label="Delete Funfact"];
    ViewFunfact [label="View Funfact"];
    SearchFunfact [label="Search Funfact"];
    
    CreateStudent [label="Create Student"];
    UpdateStudent [label="Update Student"];
    DeleteStudent [label="Delete Student"];
    ViewStudent [label="View Student"];
    SearchStudent [label="Search Student"];
    
    SubmitFeedback [label="Submit Feedback"];
    BrowseFunfacts [label="Browse Funfacts"];
    
    FillSurvey [label="Fill Survey"];
    SubmitSurvey [label="Submit Survey"];
    ValidateResponse [label="Validate Response"];
    DeleteSurvey [label="Delete Survey"];
    
    System [shape=box, style=dashed, label="System"];
    
    Admin -> CreateFunfact;
    Admin -> UpdateFunfact;
    Admin -> DeleteFunfact;
    Admin -> CreateStudent;
    Admin -> UpdateStudent;
    Admin -> DeleteStudent;
    Admin -> DeleteSurvey;
    
    User -> ViewFunfact;
    User -> SearchFunfact;
    User -> BrowseFunfacts;
    User -> SubmitFeedback;
    User -> ViewStudent;
    User -> FillSurvey;
    User -> SubmitSurvey;
    
    SubmitFeedback -> BrowseFunfacts [label="<<extend>>"];
    SubmitSurvey -> ValidateResponse [label="<<include>>"];
    
    {
        rank=same;
        CreateFunfact, UpdateFunfact, ViewFunfact, BrowseFunfacts;
    }
}
"""
    
    # Simpan dot file
    with open('temp_uml.dot', 'w') as f:
        f.write(dot_code)
    
    # Generate PNG
    try:
        subprocess.run(['dot', '-Tpng', 'temp_uml.dot', '-o', 'docs/uml.png'], check=True)
        print("✅ UML diagram berhasil dibuat: docs/uml.png")
        os.remove('temp_uml.dot')
        return True
    except Exception as e:
        print(f"❌ Error membuat UML: {e}")
        return False

def main():
    """Main function"""
    print("🎨 Generate Diagram ERD dan UML...\n")
    
    # Cek dependencies
    if not check_dependencies():
        print("\n⚠️  Graphviz diperlukan untuk generate diagram")
        print("Silakan install terlebih dahulu!")
        return False
    
    # Buat folder docs jika belum ada
    os.makedirs('docs', exist_ok=True)
    
    # Generate diagram
    erd_ok = create_erd_diagram()
    uml_ok = create_uml_diagram()
    
    if erd_ok and uml_ok:
        print("\n✅ Semua diagram berhasil dibuat!")
        print("\n📝 Langkah selanjutnya:")
        print("1. git add README.md docs/")
        print("2. git commit -m 'Add ERD and UML diagrams'")
        print("3. git push")
        return True
    else:
        print("\n❌ Ada error saat membuat diagram")
        return False

if __name__ == "__main__":
    success = main()
    sys.exit(0 if success else 1)
